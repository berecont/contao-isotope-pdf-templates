<?php

declare(strict_types=1);

/*
 * This file is part of the ContaoIsotopePdfTemplatesBundle bundle.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

use InspiredMinds\ContaoIsotopePdfTemplatesBundle\DataContainer\IsoDocumentListener;

$GLOBALS['TL_DCA']['tl_iso_document']['config']['onload_callback'][] = [IsoDocumentListener::class, 'onLoadCallback'];

$GLOBALS['TL_DCA']['tl_iso_document']['palettes']['template'] = $GLOBALS['TL_DCA']['tl_iso_document']['palettes']['standard'];

$GLOBALS['TL_DCA']['tl_iso_document']['fields']['usePdfTemplate'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['usePdfTemplate'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_iso_document']['fields']['appendPdfTemplate'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['appendPdfTemplate'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_iso_document']['fields']['useCustomFonts'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['useCustomFonts'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_iso_document']['fields']['usePdfTemplateSRC'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['usePdfTemplateSRC'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['fieldType' => 'radio', 'files' => true, 'mandatory' => true, 'extensions' => 'pdf'],
    'sql' => 'binary(16) NULL',
];

$GLOBALS['TL_DCA']['tl_iso_document']['fields']['appendPdfTemplateSRC'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['appendPdfTemplateSRC'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['fieldType' => 'radio', 'files' => true, 'mandatory' => true, 'extensions' => 'pdf'],
    'sql' => 'binary(16) NULL',
];

$GLOBALS['TL_DCA']['tl_iso_document']['fields']['customFontsDirectory'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['customFontsDirectory'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['fieldType' => 'radio', 'mandatory' => true],
    'sql' => 'binary(16) NULL',
];

$GLOBALS['TL_DCA']['tl_iso_document']['fields']['customFontsConfig'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['customFontsConfig'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'load_callback' => [[IsoDocumentListener::class, 'onCustomFontsConfigLoad']],
    'save_callback' => [[IsoDocumentListener::class, 'onCustomFontsConfigSave']],
    'eval' => [
        'disableSorting' => true,
        'columnFields' => [
            'enabled' => [
                'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['customFontsConfigEnabled'],
                'exclude' => true,
                'inputType' => 'checkbox',
            ],
            'variant' => [
                'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['customFontsConfigVariant'],
                'exclude' => true,
                'inputType' => 'select',
                'options' => ['R' => 'Regular', 'B' => 'Bold', 'I' => 'Italic', 'BI' => 'BoldItalic'],
                'reference' => &$GLOBALS['TL_LANG']['tl_iso_document']['customFontsConfigVariantOptions'],
            ],
            'filename' => [
                'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['customFontsConfigFilename'],
                'inputType' => 'text',
                'eval' => ['disabled' => true],
            ],
            'fontname' => [
                'label' => &$GLOBALS['TL_LANG']['tl_iso_document']['customFontsConfigFontname'],
                'inputType' => 'text',
            ],
        ],
    ],
    'sql' => 'blob NULL',
];

$GLOBALS['TL_DCA']['tl_iso_document']['palettes']['__selector__'][] = 'usePdfTemplate';
$GLOBALS['TL_DCA']['tl_iso_document']['palettes']['__selector__'][] = 'appendPdfTemplate';
$GLOBALS['TL_DCA']['tl_iso_document']['palettes']['__selector__'][] = 'useCustomFonts';

$GLOBALS['TL_DCA']['tl_iso_document']['subpalettes']['usePdfTemplate'] = 'usePdfTemplateSRC';
$GLOBALS['TL_DCA']['tl_iso_document']['subpalettes']['appendPdfTemplate'] = 'appendPdfTemplateSRC';
$GLOBALS['TL_DCA']['tl_iso_document']['subpalettes']['useCustomFonts'] = 'customFontsDirectory,customFontsConfig';

\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('pdftemplate_legend', 'template_legend')
    ->addField('usePdfTemplate', 'pdftemplate_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('appendPdfTemplate', 'pdftemplate_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addLegend('font_legend', 'pdftemplate_legend')
    ->addField('useCustomFonts', 'font_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('template', 'tl_iso_document')
;
