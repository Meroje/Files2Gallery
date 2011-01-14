<?php
/**
*  @author  Charles Reace (www.charles-reace.com)
*  @version 1.0
*  @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

/**
*  Read data from ini file and create a data array or object
*
*  @link http://www.php.net/parse_ini_file See the parse_ini_file() documentation for info on the ini file syntax
*/
class IniFile
{
   /**
   *  @var string relative or absolute path to the ini file
   */
   private $iniFilePath = '';
   
   /**
    * @var array relative or absolute path to all the ini files used
    */
   private $files = array();
   
   /**
   *  Constructor
   *
   *  @param string $name (optional) unique identifier to the file
   *  @param string $path (optional) path to ini file
   */
   public function __construct($name = 'global', $path = NULL)
   {
      $this->setIniFilePath($name, $path);
   }
   
   /**
   *  Set the ini file path
   *
   *  Throws exception on invalid path
   *
   *  @param string $name unique identifier to the ini file
   *  @param string $path optionnal path to the ini file if already used
   *  @return boolean
   */
   public function setIniFilePath($name, $path = NULL)
   {
      if (!array_key_exists($name, $this->files))
      {
         if (is_readable($path))
         {
            $this->files[$name] = $path;
            $this->iniFilePath = $this->files[$name];
            return $this;
         }
         else
         {
            throw new Exception("$path does not exist or is not readable.");
         }
      }
      else
      {
         $this->iniFilePath = $this->files[$name];
         return $this;
      }
   }
   
   /**
   *  parse ini file and return data as an object
   *
   *  throws exception if path not set
   *
   *  @return object
   */
   public function getIniDataObj()
   {
      if(empty($this->iniFilePath))
      {
         throw new Exception("No ini file path defined");
      }
      $dataArray = parse_ini_file($this->iniFilePath, TRUE);
      $dataObj = new stdClass();
      foreach($dataArray as $key => $value)
      {
         if(is_array($value))
         {
            foreach($value as $key2 => $value2)
            {
               $dataObj->$key->$key2 = $value2;
            }
         }
         else
         {
            $dataObj->$key = $value;
         }
      }
      return($dataObj);
   }
   
   /**
   *  parse ini file and return data as an array
   *
   *  throws exception if path not set
   *
   *  @return array
   */
   public function getIniDataArray()
   {
      if(empty($this->iniFilePath))
      {
         throw new Exception("No ini file path defined");
      }
      return(parse_ini_file($this->iniFilePath, TRUE));
   }
}