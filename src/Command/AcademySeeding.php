<?php
namespace App\Command;

use App\Data\PagesTypes\PageType;
use App\Data\Themes\Theme;
use App\Data\ThemesPagesTemplates\ThemePageTemplate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AcademySeedingCommand extends Command
{
    private $url = 'http://api.academy.ezf.develop/v1/';
    private $jwt = 'eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJqdUs5US9ZY2NkcGR4OWtWR052YjB4Nkh2dzJOYW1BL3pnZTlIOERaZGNNPSIsImRhdGEiOnsidXNlcklkIjoiMGQ5YzA1OGUtZDdhZC00MjFkLTllNTgtNWU5YzdiYzJlZDRlIn19.B4ZemeTeAh4-sadIygozxiVbUQ3KA2U0Tu2m1-Di3-C4UIWwScs9yd_Ptg230e90vxrGOKPPaLYk8RJO7_Cxog';
    private $jwtDomain = 'api.academy.ezf.develop';
    private $output;

    protected function configure()
    {
        $this->setName('start')
            ->setDescription('This command seed data to server for ez-academy service')
            ->setHelp('This command seed data to server for ez-academy service');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $theme = new Theme($this->url, $this->jwt, $this->jwtDomain);
        $pageType = new PageType($this->url, $this->jwt, $this->jwtDomain);
        $themePageTemplate = new ThemePageTemplate($this->url, $this->jwt, $this->jwtDomain);

        $themes = [];
        $pagesTypes = [];
        $themesPagesTemplates = [];
        try {
            for ($i = 1; $i < 3; $i++) {
                $id = $theme->create();
                $themes[] = $id;
                $this->outputSuccess($theme->getType(), $id);
            }

            for ($i = 1; $i < 10; $i++) {
                $id = $pageType->create();
                $pagesTypes[] = $id;
                $this->outputSuccess($pageType->getType(), $id);
            }

            for ($i = 1; $i < 10; $i++) {
                $themePageTemplate->setPageType(['type' => $pageType->getType(), 'id' => $pagesTypes[array_rand($pagesTypes)]]);
                $themePageTemplate->setTheme(['type' => $theme->getType(), 'id' => $themes[array_rand($themes)]]);
                $id = $themePageTemplate->create();
                $themesPagesTemplates[] = $id;
                $this->outputSuccess($themePageTemplate->getType(), $id);
            }

        } catch (\Exception $e) {
            $output->writeln('<error>'.$e->getMessage().'</error>');
            return $e;
        }

    }

    private function outputSuccess($type, $id)
    {
        $this->output->writeln('<info>New record of type "'.$type.'" with id = '.$id.'</info>');
    }
}