<?php
namespace MvcLite;

class CreatePdf
{
    public static string $TxtHtmlCode = '';
    public static string $TxtBaseUrl = '';
    public static string $DdlPageSize = 'A4';
    public static string $DdlPageOrientation = 'Portrait';
    public static string $TxtWidth = '1024';
    public static string $TxtHeight = '0';
    /** @var array<int,array{Value:string,Text:string}> */
    public static array $PageSizes = [
        ['Value'=>'A1','Text'=>'A1'], ['Value'=>'A2','Text'=>'A2'], ['Value'=>'A3','Text'=>'A3'],
        ['Value'=>'A4','Text'=>'A4'], ['Value'=>'A5','Text'=>'A5'], ['Value'=>'Letter','Text'=>'Letter'],
        ['Value'=>'HalfLetter','Text'=>'HalfLetter'], ['Value'=>'Ledger','Text'=>'Ledger'], ['Value'=>'Legal','Text'=>'Legal'],
    ];
    /** @var array<int,array{Value:string,Text:string}> */
    public static array $PageOrientations = [
        ['Value'=>'Portrait','Text'=>'Portrait'], ['Value'=>'Landscape','Text'=>'Landscape'],
    ];

    public static function OnGet(): void
    {
        self::$DdlPageSize = 'A4';
        self::$TxtHtmlCode = "<html>\n    <body>\n        Hello World from selectpdf.com.\n    </body>\n</html>\n";
    }

    public static function GetTimeZoneList(): array
    {
        $list = [['Text'=>'Select', 'Value'=>'']];
        foreach (\DateTimeZone::listIdentifiers() as $id) {
            $list[] = ['Text'=>trim($id), 'Value'=>$id];
        }
        return $list;
    }

    public static function getPageSizes(): array
    {
        return self::$PageSizes;
    }

    public static function getPageOrientations(): array
    {
        return self::$PageOrientations;
    }

    public static function OnPost()
    {
        $html = self::$TxtHtmlCode;
        if (class_exists('\\SelectPdf\\HtmlToPdf')) {
            $converter = new \SelectPdf\HtmlToPdf();
            $converter->Options->PdfPageSize = self::$DdlPageSize;
            $converter->Options->PdfPageOrientation = self::$DdlPageOrientation;
            $converter->Options->WebPageWidth = (int) self::$TxtWidth ?: 1024;
            $converter->Options->WebPageHeight = (int) self::$TxtHeight;
            $doc = $converter->ConvertHtmlString($html, self::$TxtBaseUrl);
            $pdf = $doc->Save();
            $doc->Close();
            return $pdf;
        }
        return $html;
    }
}
