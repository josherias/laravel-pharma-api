<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    public function render($request, Throwable $exception){
        if($exception instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($exception, $request) ;
        }

        if($exception instanceof ModelNotFoundException){
            $modelName = class_basename($exception->getModel());
            return $this->errorResponse($modelName . " with specified identifier doesnt exist", 404);
        }

        //authentication exception calls the unauthenticated also in the parent class
        if ($exception instanceof AuthenticationException) {
            // return $this->unauthenticated($request, $exception);

            //user tries to access protected routes wen unauthenticated from the front end
            if ($this->isFrontEnd($request)) {
                return redirect()->guest('login');
            }
            return $this->errorResponse("Unauthenticated", 401);
        }


        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse($exception->getMessage(), 403);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse("The specified url cant be found", 404);
        }


        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse("The method for the request is invalid", 405);
        }

          //handle all possible exceptions our restful api cud have
          if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }


        //handle database exceptions that may arise
        if ($exception instanceof QueryException) {
            $errorCode = $exception->errorInfo[1];

            if ($errorCode == 1451) {
                return $this->errorResponse("Cannot delete the resource permanately. Its associated with othe resources", 409);
            }
        }

        //if tempered with token from form redirect user back to llgin page
        if ($exception instanceof TokenMismatchException) {
            return redirect()->back()->withInput($request->input());
        }

        //if in local env
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        //handlin unexpected exceptions in prod
        return $this->errorResponse("Unexpected Exception, try again later", 500);
    }


     /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors  = $e->validator->errors()->getMessages();

        if ($this->isFrontEnd($request)) {
            // request is ajax request return json response otherwise redirect back user
            return $request->ajax() ? response()->json($errors, 422) : redirect()->back()->withInput($request->input())->withErrors($errors);
        }

        return $this->errorResponse($errors, 422);
    }


    //detremine wether route is from the web side or the api side
    private function isFrontEnd($request)
    {
        //request accept html and then create a collection  to find if t has middleware called web
        return $request->acceptsHtml() && collect($request->route()->middleware())->contains('web');
    }

}
