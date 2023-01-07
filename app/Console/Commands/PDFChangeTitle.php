<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PDFChangeTitle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:update-info {input} {output} {title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the info data in a PDF file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pdf_file_path = $this->argument('input');
        $metadata_file_path = $this->argument('output');

        $command = "pdftk {$pdf_file_path} dump_data output {$metadata_file_path}";

        exec($command);

        $search = '80067 &#1571;&#1578;&#1601;&#1575;&#1602;&#1610;&#1577; &#1581;&#1580;&#1586; &#1585;&#1602;&#1605;.pdf';
        $replace =  $this->argument('title');

        $file = file_get_contents($metadata_file_path);
        $file = str_replace($search, $replace, $file);
        file_put_contents($metadata_file_path, $file);

        $pdf_live = public_path() . '/assets/pdfjs/web/madar.pdf';

        exec("pdftk $pdf_live update_info $metadata_file_path output $pdf_live");

        $this->info('PDF info updated successfully!');
    }
}
