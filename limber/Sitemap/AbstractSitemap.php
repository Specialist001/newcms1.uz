<?php

namespace Limber\Sitemap;

abstract class AbstractSitemap
{
   protected $root = 'sitemap';

   protected $xmlns = 'http://www.sitemaps.org/schemas/sitemap/0.9';

   protected $encoding = 'utf-8';

   protected $xmlVersion = '1.0';

   protected $xml;

   protected $autoEscape = true;
   
   protected $dateFormat = '';

   public function __construct($xmlns = null, $encoding = 'utf-8', $xmlVersion = '1.0')
   {
     $this->xmlns      = $xmlns ? : $this->xmlns;
     $this->encoding   = $encoding;
     $this->xmlVersion = $XmlVersion;

     $this->dateFormat = \DateTime::W3C;

     $this->xml = $this->getSimpleXmlElement();
   }

   public function getSimpleXmlElement()
   {
     if (!$this->xml) {
         $this->xml = simplexml_load_string(
             sprintf(
                '<?xml version="%s" encoding="%s"?' . '><%s xmlns="%s" />',
                $this->xmlVersion,
                $this->encoding,
                $this->root,
                $this->xmlns
             )
         );
     }

     return $this->xml;
   }

   public function toString()
   {
	return $this->xml->asXML();
   }

   public function __toString()
   {
	try {
		return $this->toString();
	} catch (\Exception $e) {
		     return $e;
	  }
   }

   public function getAutoEscape()
   {
       return $this->autoEscape;
   }

   public function setAutoEscape($autoEscape)
   {
       $this->autoEscape = $autoEscape;

       return $this;
   }

   public function getDateFormat()
   {
       return $this->dateFormat;
   }

   public function setDateFormat($dateFormat)
   {
       $this->dateFormat = $dateFormat;

       return $this;
   }
}