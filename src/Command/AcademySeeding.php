<?php
namespace App\Command;

use App\Data\Academies\AcademyPackage;
use App\Data\Academies\AcademySingle;
use App\Data\AcademiesMenus\AcademyMenu;
use App\Data\Courses\Course;
use App\Data\Courses\CoursePackage;
use App\Data\Groups\Group;
use App\Data\Orders\Order;
use App\Data\Packages\Package;
use App\Data\PagesTemplates\PageTemplate;
use App\Data\PagesTypes\PageType;
use App\Data\Socials\Social;
use App\Data\Themes\Theme;
use App\Data\Members\Member;
use App\Data\ThemesPagesTemplates\ThemePageTemplate;
use App\Helpers\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AcademySeedingCommand extends Command
{
    /** @var Config */
    private $config;

    /** @var OutputInterface */
    private $output;

    protected function configure()
    {
        $this->config = new Config(
            getenv('API_URL'),
            getenv('AUTH_JWT'),
            getenv('DOMAIN_JWT'),
            getenv('USER_ID')
        );

        $this->setName('start')
            ->setDescription('This command seed data to server for ez-academy service')
            ->setHelp('This command seed data to server for ez-academy service');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $starttime = microtime(true);

        $this->output = $output;

        $theme = new Theme($this->config);
        $pageType = new PageType($this->config);
        $themePageTemplate = new ThemePageTemplate($this->config);

        $academySingle = new AcademySingle($this->config);
        $academySingle->setUserIdField($this->config->getUserId());

        $academyPackage = new AcademyPackage($this->config);
        $academyPackage->setUserIdField($this->config->getUserId());

        $group = new Group($this->config);
        $pageTemplate = new PageTemplate($this->config);
        $academyMenu = new AcademyMenu($this->config);
        $social = new Social($this->config);


        $package = new Package($this->config);
        $course = new Course($this->config);
        $coursePackage = new CoursePackage($this->config);

        $member = new Member($this->config);
        $order = new Order($this->config);

        try {
            for ($i = 0; $i < 5; $i++) {
                $themes[] = $theme->create()->getId();
                $this->outputSuccess($theme->getType(), $theme->getId());
            }

            for ($i = 0; $i < 10; $i++) {
                $pagesTypes[] = $pageType->create()->getId();
                $this->outputSuccess($pageType->getType(), $pageType->getId());
            }

            for ($i = 0; $i < 10; $i++) {
                $themePageTemplate->setPageType($pageType->getType(), $pageType->getRandomIds($pagesTypes));
                $themePageTemplate->setTheme($theme->getType(), $theme->getRandomIds($themes));
                $themesPagesTemplates[] = $themePageTemplate->create()->getId();
                $this->outputSuccess($themePageTemplate->getType(), $themePageTemplate->getId());
            }

            $academySingle->setTheme($theme->getType(), $theme->getRandomIds($themes))->create();
            $this->outputSuccess($academySingle->getType().' single', $academySingle->getId());

            $academyPackage->setTheme($theme->getType(), $theme->getRandomIds($themes))->create();
            $this->outputSuccess($academyPackage->getType().' package', $academyPackage->getId());

            for ($i = 0; $i < 10; $i++) {
                $pageTemplate->setAcademy($academySingle->getType(), $academySingle->getId())
                    ->setTheme('themes',$theme->getRandomIds($themes))
                    ->setPageType('pages-types',$pageType->getRandomIds($pagesTypes))
                    ->create();

                $pageTemplateSingleIds[] = $pageTemplate->getId();
                $this->outputSuccess($pageTemplate->getType().' single', $pageTemplate->getId());
            }

            for ($i = 0; $i < 10; $i++) {
                $pageTemplate->setAcademy($academyPackage->getType(), $academyPackage->getId())
                    ->setTheme('themes',$theme->getRandomIds($themes))
                    ->setPageType('pages-types',$pageType->getRandomIds($pagesTypes))
                    ->create();

                $pageTemplateSingleIds[] = $pageTemplate->getId();
                $this->outputSuccess($pageTemplate->getType().' package', $pageTemplate->getId());
            }

            for ($i = 0; $i < 5; $i++) {
                $academyMenu->setAcademy($academySingle->getType(), $academySingle->getId())
                    ->setPageType('pages-types', $pageType->getRandomIds($pagesTypes))
                    ->create();

                $academyMenuSingleIds[] = $academyMenu->getId();
                $this->outputSuccess($academyMenu->getType().' single', $academyMenu->getId());
            }

            for ($i = 0; $i < 5; $i++) {
                $academyMenu->setAcademy($academyPackage->getType(), $academyPackage->getId())
                    ->setPageType('pages-types',$pageType->getRandomIds($pagesTypes))
                    ->create();

                $academyMenuPackageIds[] = $academyMenu->getId();
                $this->outputSuccess($academyMenu->getType().' package', $academyMenu->getId());
            }

            for ($i = 0; $i < 3; $i++) {
                $social->setAcademy($academySingle->getType(),$academySingle->getId())->create();
                $socialSingleIds[] = $social->getId();
                $this->outputSuccess($social->getType().' single', $social->getId());
            }
            for ($i = 0; $i < 3; $i++) {
                $social->setAcademy($academyPackage->getType(),$academyPackage->getId())->create();
                $socialPackageIds[] = $social->getId();
                $this->outputSuccess($social->getType().' package', $social->getId());
            }

            for ($i = 0; $i < 5; $i++) {
                $group->setAcademy($academySingle->getType(),$academySingle->getId())->create();
                $groupSingleIds[] = $group->getId();
                $this->outputSuccess($group->getType().' single', $group->getId());
            }
            for ($i = 0; $i < 5; $i++) {
                $group->setAcademy($academyPackage->getType(),$academyPackage->getId())->create();
                $groupPackageIds[] = $group->getId();
                $this->outputSuccess($group->getType().' package', $group->getId());
            }

//            for ($i = 0; $i < 25; $i++) {
//                $membersSingle[] = $member->setAcademy($academySingle->getType(), $academySingle->getId())->create();
//                $this->outputSuccess(
//                    $member->getType(),
//                    $member->getId(),
//                    'With email='.$member->getEmailField().' and password='.$member->getPasswordField()
//                );
//            }

            for ($i = 0; $i < 5; $i++) {
                $package->setAcademy($academyPackage->getType(), $academyPackage->getId())->create();
                $packages[] = $package->getId();
                $this->outputSuccess(
                    $package->getType(),
                    $package->getId(),
                    'With academyId = '.$academyPackage->getId()
                );
            }

            for ($i = 0; $i < 10; $i++) {
                $course->setAcademy($academySingle->getType(), $academySingle->getId())
                    ->setGroup($group->getType(),$group->getRandomIds($groupSingleIds))
                    ->create();
                $courseSingleIds[] = $course->getId();
                $this->outputSuccess(
                    $course->getType(),
                    $course->getId(),
                    'With academyId = '.$academySingle->getId()
                );
            }

            for ($i = 0; $i < 10; $i++) {
                $course->setAcademy($academySingle->getType(), $academySingle->getId())
                    ->setGroup($group->getType(),$group->getRandomIds($groupSingleIds))
                    ->setRelatedCourses('related-courses', $course->getRandomIds($courseSingleIds, 2))
                    ->create();
                $courseSingleIds[] = $course->getId();

                    $this->outputSuccess(
                    $course->getType(),
                    $course->getId(),
                    'With academyId = '.$academySingle->getId()
                );
            }

            for ($i = 0; $i < 10; $i++) {
                $coursePackage
                    ->setPackages($package->getType(), $package->getRandomIds($packages, 2))
                    ->setAcademy($academyPackage->getType(), $academyPackage->getId())
                    ->setGroup($group->getType(),$group->getRandomIds($groupPackageIds))
                    ->create();

                $coursePackageIds[] = $coursePackage->getId();

                    $this->outputSuccess(
                    $course->getType(),
                    $course->getId(),
                    'With academyId = '.$academyPackage->getId()
                );
            }

            for ($i = 0; $i < 10; $i++) {
                $coursePackage
                    ->setRelatedPackages('related-packages', $package->getRandomIds($packages, 2))
                    ->setPackages($package->getType(), $package->getRandomIds($packages, 2))
                    ->setAcademy($academyPackage->getType(), $academyPackage->getId())
                    ->setGroup($group->getType(),$group->getRandomIds($groupPackageIds))
                    ->create();
                $coursePackageIds[] = $coursePackage->getId();

                    $this->outputSuccess(
                    $course->getType(),
                    $course->getId(),
                    'With academyId = '.$academyPackage->getId()
                );
            }

            for ($i = 0; $i < 25; $i++) {
                $order
                    ->setAcademy($academyPackage->getType(), $academyPackage->getId())
                    ->setPackages($package->getType(), $package->getRandomIds($packages, 3))
                    ->create();
                $orders[] = $order->getId();

                    $this->outputSuccess(
                    $order->getType(),
                    $order->getId(),
                    'With academyId = '.$academyPackage->getId()
                );
            }

            for ($i = 0; $i < 25; $i++) {
                $order
                    ->setAcademy($academySingle->getType(), $academySingle->getId())
                    ->setCourses($course->getType(), $course->getRandomIds($courseSingleIds, 3))
                    ->create();

                $orders[] = $order->getId();

                    $this->outputSuccess(
                    $order->getType(),
                    $order->getId(),
                    'With academyId = '.$academySingle->getId()
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