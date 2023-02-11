<?php


namespace App\Helper;


use App\Models\Institute;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CustomHelper {
  private static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
  private static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

  const PhoneNoRegex = "/^(?=.{11}$)(01)\d+$/";
//  const NidRegex = "/(?:\d{17}|\d{13}|\d{10})/";


    private static function fileSizeFormat( $bytes ): string
    {
        $label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /= 1024, $i++ );
        return( round( $bytes, 2 ) . " " . $label[$i] );
    }

  /**
   * @param $image
   * @param $path
   * @return bool|string
   */
  public static function storeImage($image, $path): bool|string {
    $path = '/uploads' . $path;
    try {
      $name = time() . '.' . $image->getClientOriginalExtension();
      $destinationPath = public_path($path);
      $image->move($destinationPath, $name);
      if (isset($name)) {
        return $path . $name;
      }
      return false;
    } catch (\Exception $e) {
      return false;
    }
  }
  public static function fileSystem($image, $path) {
    $path = '/uploads' . $path;
    try {
     $file = new \stdClass;
     $file->size = self::fileSizeFormat($image->getSize());
     $file->name = $image->getClientOriginalName();
     $file->type = ".".$image->getClientOriginalExtension();
      $name = time() . '.' . $image->getClientOriginalExtension();
      $destinationPath = public_path($path);
     $file->file = $destinationPath;
      $image->move($destinationPath, $name);
      if (isset($name)) {
         $file->path = $path.$name;
         return $file;
        return Storage::size(public_path($image));
      }
      return false;
    } catch (\Exception $e) {
      return false;
    }
  }

  public static function deleteFile($image = null) {
    if ($image !== null) {
      $old_image_path = public_path($image);
      if (file_exists($old_image_path)) {
        @unlink($old_image_path);
      }
    }
  }

  /**
   * @param $string
   * @param int $length
   * @param string $pad_string
   * @return string
   */
  public static function fillLeft($string, $length = 7, $pad_string = '0'): string {
    return str_pad($string, $length, $pad_string, STR_PAD_LEFT);
  }


  /**
   * @param User $user
   */
  public static function removeUsersRole(User $user) {
    foreach ($user->roles as $role) {
      $user->removeRole($role);
    }
  }

  /**
   * get user First Role Name
   * @return mixed|string
   */
  public static function userRoleName($user = null) {
    $roles = auth()->user()->getRoleNames();
    if ($user != null) {
      $roles = $user->getRoleNames();
    }
    if ($roles->count() > 0) {
      return $roles->first();
    }
    return "";
  }

  /**
   * @param string $string
   * @param string $separator
   * @return false|string[]
   */
  public static function stringToArray(string $string, string $separator = '|') {
    return explode($separator, $string);
  }

  /**
   * @param array $array
   * @param string $separator
   * @return string
   */
  public static function arrayToString(array $array, string $separator = ',') {
    return implode($separator, $array);
  }

  /**
   * @param string $permission
   * @param string|null $role
   * @return bool
   */
  public static function canView(string $permission, string $role = null): bool {
    if ($role == null) {
      return self::hasAnyPermission($permission);
    }
    return (self::hasAnyRole($role) || self::hasAnyPermission($permission));
  }

  /**
   * @param string $permission
   * @return false
   */
  public static function hasAnyPermission(string $permission): bool {
    if (!($user = auth()->user())) {
      return false;
    }
    if (!($permissions = self::stringToArray($permission))) {
      return false;
    }
    if (count($permissions) < 1) {
      return false;
    }
    return $user->hasAnyPermission($permissions);
  }

  /**
   * @param string $permission
   * @return false
   */
  public static function hasAnyRole(string $role): bool {
    if (!($user = auth()->user())) {
      return false;
    }
    if (!($roles = self::stringToArray($role))) {
      return false;
    }
    if (count($roles) < 1) {
      return false;
    }
    return $user->hasAnyRole($roles);
  }


  public static function bn2en($number) {
    return str_replace(self::$bn, self::$en, $number);
  }

  public static function en2bn($number) {
    return str_replace(self::$en, self::$bn, $number);
  }

  public static function convertLocaleNumber($string) {
    return (app()->getLocale() == 'en') ? $string : self::en2bn($string);
  }

  public static function makeDateUseable(string $year, int $subYear = 0) {
    if ($subYear === 0) {
      $returnAbleYear = Carbon::createFromFormat('Y', $year);
    }
    $returnAbleYear = Carbon::createFromFormat('Y', $year)->subYear($subYear);
    return self::convertLocaleNumber($returnAbleYear->format('Y'));
  }

  /**
   * @param string $date
   * @param string $format
   * @return string
   */
  public static function makeDateFormat(string $date, string $format = 'F d, Y'): string {
    $carbonDate = Carbon::parse($date);
    return $carbonDate->format($format);
  }


  /**
   * @param string $startDate
   * @param string $endDate
   * @param string $format
   * @return string
   */
  public static function dateDiffReadable(string $startDate, string $endDate, string $format = 'Month:%m Day:%d'): string {
    $startDate = Carbon::parse($startDate);
    $finishDate = Carbon::parse($endDate);
    return $finishDate->diff($startDate)->format($format);
  }




  /**
   * @param $number
   * @return string
   * @throws \Exception
   */
  public static function numToEnglishWord($number): string
  {
    if (($number < 0) || ($number > 999999999)) {
      throw new \Exception("Number is out of range");
    }
    $Kt = floor($number / 10000000); /* Koti */
    $number -= $Kt * 10000000;
    $Gn = floor($number / 100000);  /* lakh  */
    $number -= $Gn * 100000;
    $kn = floor($number / 1000);     /* Thousands (kilo) */
    $number -= $kn * 1000;
    $Hn = floor($number / 100);      /* Hundreds (hecto) */
    $number -= $Hn * 100;
    $Dn = floor($number / 10);       /* Tens (deca) */
    $n = $number % 10;               /* Ones */

    $res = "";

    if ($Kt) {
      $res .= self::numToEnglishWord($Kt) . " Koti ";
    }
    if ($Gn) {
      $res .= self::numToEnglishWord($Gn) . " Lakh";
    }

    if ($kn) {
      $res .= (empty($res) ? "" : " ") .
        self::numToEnglishWord($kn) . " Thousand";
    }

    if ($Hn) {
      $res .= (empty($res) ? "" : " ") .
        self::numToEnglishWord($Hn) . " Hundred";
    }

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
      "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
      "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen",
      "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty",
      "Seventy", "Eighty", "Ninety");

    if ($Dn || $n) {
      if (!empty($res)) {
        $res .= " and ";
      }

      if ($Dn < 2) {
        $res .= $ones[$Dn * 10 + $n];
      } else {
        $res .= $tens[$Dn];

        if ($n) {
          $res .= "-" . $ones[$n];
        }
      }
    }
    if (empty($res)) {
      $res = "zero";
    }
    return $res;
  }

  /**
   * @param $value
   * @param string $decimal_separator
   * @param string $thousand_separator
   * @return string
   */
  public static function makePriceFormat($value, string $decimal_separator = '.', string $thousand_separator = ','): string {
    return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
  }

  /**
   * @return bool
   */
  public static function isInstituteTrainingProvider(): bool {
    if (auth()->user() && $institute = Institute::find(auth()->user()->institute_id)){
      return $institute->type == Institute::$typeArrays[1];
    }
    return false;
  }
}
