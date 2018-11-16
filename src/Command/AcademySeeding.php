<?php
namespace App\Command;

use App\Data\Academies\AcademyPackage;
use App\Data\Academies\AcademySingle;
use App\Data\Packages\Package;
use App\Data\PagesTypes\PageType;
use App\Data\Themes\Theme;
use App\Data\Members\Member;
use App\Data\ThemesPagesTemplates\ThemePageTemplate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AcademySeedingCommand extends Command
{
    private $url = 'http://api.academy.ezf.develop/v1/';
    private $jwt = 'eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJqdUs5US9ZY2NkcGR4OWtWR052YjB4Nkh2dzJOYW1BL3pnZTlIOERaZGNNPSIsImRhdGEiOnsidXNlcklkIjoiMGQ5YzA1OGUtZDdhZC00MjFkLTllNTgtNWU5YzdiYzJlZDRlIn19.B4ZemeTeAh4-sadIygozxiVbUQ3KA2U0Tu2m1-Di3-C4UIWwScs9yd_Ptg230e90vxrGOKPPaLYk8RJO7_Cxog';
    private $jwtDomain = 'api.academy.ezf.develop';
    private $userId = '0d9c058e-d7ad-421d-9e58-5e9c7bc2ed4e';
    /** @var OutputInterface */
    private $output;

    protected function configure()
    {
        $this->setName('start')
            ->setDescription('This command seed data to server for ez-academy service')
            ->setHelp('This command seed data to server for ez-academy service');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $starttime = microtime(true);

        $this->output = $output;

        $theme = new Theme($this->url, $this->jwt, $this->jwtDomain);
        $pageType = new PageType($this->url, $this->jwt, $this->jwtDomain);
        $themePageTemplate = new ThemePageTemplate($this->url, $this->jwt, $this->jwtDomain);

        $academySingle = new AcademySingle($this->url, $this->jwt, $this->jwtDomain);
        $academySingle->setUserIdField($this->userId);

        $academyPackage = new AcademyPackage($this->url, $this->jwt, $this->jwtDomain);
        $academyPackage->setUserIdField($this->userId);

        $package = new Package($this->url, $this->jwt, $this->jwtDomain);

        $member = new Member($this->url, $this->jwt, $this->jwtDomain);

        $themes = [];
        $pagesTypes = [];
        $themesPagesTemplates = [];
        try {
            for ($i = 1; $i < 3; $i++) {
                $themes[] = $theme->create()->getId();
                $this->outputSuccess($theme->getType(), $theme->getId());
            }

            for ($i = 1; $i < 4; $i++) {
                $pagesTypes[] = $pageType->create()->getId();
                $this->outputSuccess($pageType->getType(), $pageType->getId());
            }

            for ($i = 1; $i < 4; $i++) {
                $themePageTemplate->setPageType($pageType->getType(), $pageType->getRandomIds($pagesTypes));
                $themePageTemplate->setTheme($theme->getType(), $theme->getRandomIds($themes));
                $themesPagesTemplates[] = $themePageTemplate->create()->getId();
                $this->outputSuccess($themePageTemplate->getType(), $themePageTemplate->getId());
            }

            $academySingle->setTheme($theme->getType(), $theme->getRandomIds($themes))->create();
            $this->outputSuccess($academySingle->getType().' single', $academySingle->getId());

            $academyPackage->setTheme($theme->getType(), $theme->getRandomIds($themes))->create();
            $this->outputSuccess($academyPackage->getType().' package', $academyPackage->getId());

            for ($i = 1; $i < 300; $i++) {
                $membersSingle[] = $member->setAcademy($academySingle->getType(), $academySingle->getId())->create();
                $this->outputSuccess(
                    $member->getType(),
                    $member->getId(),
                    'With email='.$member->getEmailField().' and password='.$member->getPasswordField()
                );
            }

            for ($i = 1; $i < 2; $i++) {
                $packages[] = $package->setAcademy($academyPackage->getType(), $academyPackage->getId())->create();
                $this->outputSuccess(
                    $package->getType(),
                    $package->getId(),
                    'With academyId = '.$academyPackage->getId()
                );
            }

        } catch (\Exception $e) {
            $output->writeln('<error>'.$e->getMessage().'</error>');
            return $e;
        }

        $duration = microtime(true) - $starttime;

        $this->output->writeln('<fg=black;bg=green>TASK COMPLETE! EXECUTION TIME: '.$duration.'</>');
    }

    private function outputSuccess($type, $id, $additional = null)
    {
        $this->output->writeln('<info>New record of type "'.$type.'" with id = '.$id.' '.$additional.'</info>');
    }
}