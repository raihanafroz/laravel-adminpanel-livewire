<?php

namespace App\Helper;

use Illuminate\Support\Facades\Validator;

class RedirectHelper
{
  /**
   * @param $route
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function route($route): \Illuminate\Http\RedirectResponse
  {
    return redirect()->route($route);
  }

  /**
   * @param $route
   * @param string $message
   * @param array $params
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function routeSuccessWithParams($route, string $message = '<strong>Congratulations!!!</strong>', array $params = []): \Illuminate\Http\RedirectResponse
  {
//    AlertHelper::success($message);
    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->route($route,$params)->with('status', $status);
  }

  /**
   * @param $route
   * @param string $message
   * @param array $params
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function routeWarningWithParams($route, string $message = '<strong>Congratulations!!!</strong>', array $params = []): \Illuminate\Http\RedirectResponse
  {
//    AlertHelper::success($message);
    $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->route($route,$params)->with('status', $status);
  }


  /**
   * @param $route
   * @param string $message
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function routeSuccess($route, string $message = '<strong>Congratulations!!!</strong>'): \Illuminate\Http\RedirectResponse
  {
//    AlertHelper::success($message);
    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->route($route)->with('status', $status);
  }

  /**
   * @param $route
   * @param string $message
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function success($route,$params = [], string $message = '<strong>Congratulations!!!</strong>'): \Illuminate\Http\RedirectResponse
  {
//    AlertHelper::success($message);
    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->route($route, $params)->with('status', $status);
  }

  /**
   * @param $route
   * @param string $message
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function routeWarning($route, string $message = '<strong>Sorry!!!</strong>'): \Illuminate\Http\RedirectResponse
  {
//    AlertHelper::warning($message);
    $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->route($route)->with('status', $status);
  }

  /**
   * @param $route
   * @param string $message
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function routeError($route, string $message = '<strong>Sorry!!!</strong>'): \Illuminate\Http\RedirectResponse
  {
    $status = '<div class="alert alert-danger alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->route($route)->with('status', $status);
  }

  /**
   * @param $route
   * @param string $message
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function routeInfo($route, string $message = '<strong>Congratulations!!!</strong>'): \Illuminate\Http\RedirectResponse
  {
    $status = '<div class="alert alert-info alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->route($route)->with('status', $status);
  }

  /**
   * @param string $message
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function back(string $message = '<strong>Congratulation!!! </strong> Process Successful.'): \Illuminate\Http\RedirectResponse
  {
    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->back()->with('status', $status);
  }

  /**
   * @param string $message
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function backWithWarning(string $message = '<strong>Sorry!!! </strong> Action not completed.'): \Illuminate\Http\RedirectResponse
  {
    $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->back()->with('status', $status)->withInput();
  }

  /**
   * @param $validator
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function backWithValidationError($validator): \Illuminate\Http\RedirectResponse
  {
    return redirect()->back()->withInput()->withErrors($validator);
  }

  /**
   * @param string $message
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function backWithInput(string $message = '<strong>Sorry!!! </strong> Update not possible.'): \Illuminate\Http\RedirectResponse
  {
//    AlertHelper::warning($message);
    $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->back()->with('status', $status)->withInput();
  }

  /**
   * @param string $message
   * @return \Illuminate\Http\RedirectResponse
   */
  public static function backWithInputFromException(string $message = '<strong>Sorry!!! </strong> Something went wrong.'): \Illuminate\Http\RedirectResponse
  {
//    AlertHelper::error($message);
    $status = '<div class="alert alert-danger alert-dismissible show" role="alert">
                ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    return redirect()->back()->with('status', $status)->withInput();
  }
}
