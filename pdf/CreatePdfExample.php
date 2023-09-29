<?php

use VerumConsilium\Browsershot\Facades\PDF;

class CreatePdfExample
{
    public function pdfFilename(): string
    {
       return "example.pdf";
    }

    public function pdf(): \VerumConsilium\Browsershot\PDF
    {
        $customer = auth()->user();

        $products = $customer->products()->get();

        $theme = 'some_theme';

        $header = view('pdf.header', [
            'theme' => $theme,
        ]);

        $footer = view('pdf.footer', [
            'theme' => $theme,
        ]);

        return PDF::loadView('portfolio', [
            'products' => $products,
            'customer' => $customer,
            'theme' => $theme,

        ])
            ->format('A4')
            ->margins(66, 13, 68, 13)
            ->showBrowserHeaderAndFooter()
            ->footerHtml($footer)
            ->headerHtml($header)
            ->addChromiumArguments([
                'font-render-hinting' => 'none',
            ])
            ->waitUntilNetworkIdle()
            ->noSandbox();
    }
}
