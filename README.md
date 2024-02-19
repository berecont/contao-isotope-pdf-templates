[![](https://img.shields.io/packagist/v/inspiredminds/contao-isotope-pdf-templates.svg)](https://packagist.org/packages/inspiredminds/contao-isotope-pdf-templates)
[![](https://img.shields.io/packagist/dt/inspiredminds/contao-isotope-pdf-templates.svg)](https://packagist.org/packages/inspiredminds/contao-isotope-pdf-templates)

Contao Isotope PDF Templates
=====================

Adds a new document type in Contao Isotope where you can define PDF templates.  

__PDF Version:__ PDF document up to PDF version 1.4

__Important:__ version 2.x of this extension uses [mPDF](https://mpdf.github.io/) instead of TCPDF. Here are some things to note:

* mPDF only supports the following fonts: https://mpdf.github.io/fonts-languages/fonts-in-mpdf-7-x.html.
* mPDF has superior HTML and CSS capabilities.
* It is recommended to use a full HTML markup in your `iso_document_…` template.

![Screenshot](https://raw.githubusercontent.com/inspiredminds/contao-isotope-pdf-templates/master/screenshot.png)

## Custom fonts

Since version `2.1.0` you are able to integrate custom fonts directly via the 
back end. First you need to upload the TTF files into a directory within `/files`. 
Then you need to chose that folder in the font settings of the document. After
choosing the correct folder you need to save the settings, then you will be able
to configure the discovered font files.

![Screenshot](https://raw.githubusercontent.com/inspiredminds/contao-isotope-pdf-templates/master/font_screenshot.png)

For each font you want to use you need enable it and set the variant and family 
name of the font.

## Event

The extension provides a `ModifyPdfEvent` with which you can access the `mPDF` Isotope `Document` instance, in order
to change some parameters or add additional variables etc.

```php
// src/EventListener/ModifyPdfEventListener.php
namespace App\EventListener;

use InspiredMinds\ContaoIsotopePdfTemplatesBundle\Event\ModifyPdfEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ModifyPdfEvent::EVENT_NAME)]
class ModifyPdfEventListener
{
    public function __invoke(ModifyPdfEvent $event): void
    {
        // Access the mPDF object instance
        $mpdf = $event->getPdf();

        // Access the Isotope Document instance
        $document = $event->getDocument();
    }
}
```
