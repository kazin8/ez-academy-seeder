<?php
namespace App\Command;

use App\Data\Academies\AcademyPackage;
use App\Data\Academies\AcademySingle;
use App\Data\AcademiesMenus\AcademyMenu;
use App\Data\Actions\Action;
use App\Data\ActionsTagsAdds\ActionTagAdd;
use App\Data\ActionsTagsDeletes\ActionTagDelete;
use App\Data\Answers\Answer;
use App\Data\Courses\Course;
use App\Data\Courses\CoursePackage;
use App\Data\CoursesProducts\CourseProduct;
use App\Data\Groups\Group;
use App\Data\Lessons\Lesson;
use App\Data\Modules\Module;
use App\Data\Orders\Order;
use App\Data\Packages\Package;
use App\Data\PackagesFeatures\PackageFeature;
use App\Data\PackagesProducts\PackageProduct;
use App\Data\PagesTemplates\PageTemplate;
use App\Data\PagesTypes\PageType;
use App\Data\Questions\Question;
use App\Data\Quizzes\Quiz;
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
        $academySingle->setUser('user', $this->config->getUserId());

        $academyPackage = new AcademyPackage($this->config);
        $academyPackage->setUser('user', $this->config->getUserId());

        $action = new Action($this->config);
        $actionTagAdd = new ActionTagAdd($this->config);
        $actionTagDelete = new ActionTagDelete($this->config);

        $group = new Group($this->config);
        $pageTemplate = new PageTemplate($this->config);
        $academyMenu = new AcademyMenu($this->config);
        $social = new Social($this->config);


        $package = new Package($this->config);
        $packageProduct = new PackageProduct($this->config);
        $packageFeature = new PackageFeature($this->config);

        $course = new Course($this->config);
        $coursePackage = new CoursePackage($this->config);
        $courseProduct = new CourseProduct($this->config);

        $module = new Module($this->config);
        $lesson = new Lesson($this->config);
        $quiz = new Quiz($this->config);
        $question = new Question($this->config);
        $answer = new Answer($this->config);

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

            for ($i = 0; $i < 25; $i++) {
                $membersSingle[] = $member->setAcademy($academySingle->getType(), $academySingle->getId())->create();
                $this->outputSuccess(
                    $member->getType(),
                    $member->getId(),
                    'With email='.$member->getEmailField().' and password='.$member->getPasswordField()
                );
            }

            for ($i = 0; $i < 25; $i++) {
                $membersPackage[] = $member->setAcademy($academyPackage->getType(), $academyPackage->getId())->create();
                $this->outputSuccess(
                    $member->getType(),
                    $member->getId(),
                    'With email='.$member->getEmailField().' and password='.$member->getPasswordField()
                );
            }

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
                $packageProduct->setPackage($package->getType(), $package->getRandomIds($packages))->create();
                $packageProducts[] = $packageProduct->getId();
                $this->outputSuccess(
                    $packageProduct->getType(),
                    $packageProduct->getId(),
                    'With academyId = '.$academyPackage->getId()
                );
            }

            for ($i = 0; $i < 30; $i++) {
                $packageFeature->setPackage($package->getType(), $package->getRandomIds($packages))->create();
                $packageFeatures[] = $packageFeature->getId();
                $this->outputSuccess(
                    $packageFeature->getType(),
                    $packageFeature->getId(),
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

            for ($i = 0; $i < 50; $i++) {
                $courseProduct->setCourse($course->getType(), $course->getRandomIds($courseSingleIds))->create();
                $courseProducts[] = $courseProduct->getId();
                $this->outputSuccess(
                    $courseProduct->getType(),
                    $courseProduct->getId(),
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
                        $coursePackage->getType(),
                        $coursePackage->getId(),
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
                        $coursePackage->getType(),
                        $coursePackage->getId(),
                    'With academyId = '.$academyPackage->getId()
                );
            }

            for ($i = 0; $i < 25; $i++) {
                $module->setCourse($course->getType(), $course->getRandomIds($courseSingleIds))->create();
                $modules[] = $module->getId();
                $this->outputSuccess(
                    $module->getType(),
                    $module->getId(),
                    'With academyId = '.$academySingle->getId()
                );
            }

            for ($i = 0; $i < 25; $i++) {
                $module->setCourse($coursePackage->getType(), $coursePackage->getRandomIds($coursePackageIds))->create();
                $modules[] = $module->getId();
                $this->outputSuccess(
                    $module->getType(),
                    $module->getId(),
                    'With academyId = '.$academyPackage->getId()
                );
            }

            for ($i = 0; $i < 100; $i++) {
                $lesson->setModule($module->getType(), $lesson->getRandomIds($modules))->create();
                $lessons[] = $lesson->getId();
                $this->outputSuccess(
                    $lesson->getType(),
                    $lesson->getId()
                );
            }


            for ($i = 0; $i < 50; $i++) {
                $quiz->setLesson($lesson->getType(), $quiz->getRandomIds($lessons))->create();
                $quizzes[] = $quiz->getId();
                $this->outputSuccess(
                    $quiz->getType(),
                    $quiz->getId()
                );
            }

            for ($i = 0; $i < 50; $i++) {
                $question->setQuiz($quiz->getType(), $question->getRandomIds($quizzes))->create();
                $questions[] = $question->getId();
                $this->outputSuccess(
                    $question->getType(),
                    $question->getId()
                );
            }

            for ($i = 0; $i < 50; $i++) {
                $answer->setQuestion($question->getType(), $answer->getRandomIds($questions))->create();
                $answers[] = $answer->getId();
                $this->outputSuccess(
                    $answer->getType(),
                    $answer->getId()
                );
            }

            for ($i = 0; $i < 10; $i++) {
                $action->setAcademy($academySingle->getType(), $academySingle->getId())
                    ->setCourses($course->getType(), $action->getRandomIds($courseSingleIds, 2))
                    ->create();

                $actions[] = $action->getId();
                $this->outputSuccess($action->getType().' single', $action->getId());
            }

            for ($i = 0; $i < 10; $i++) {
                $action->setAcademy($academyPackage->getType(), $academyPackage->getId())
                    ->setCourses($coursePackage->getType(), $action->getRandomIds($coursePackageIds, 2))
                    ->create();

                $actions[] = $action->getId();
                $this->outputSuccess($action->getType().' package', $action->getId());
            }

            for ($i = 0; $i < 10; $i++) {
                $actionTagAdd->setAction($action->getType(), $actionTagAdd->getRandomIds($actions))
                    ->create();

                $actionsTagAdds[] = $actionTagAdd->getId();
                $this->outputSuccess($actionTagAdd->getType(), $actionTagAdd->getId());
            }

            for ($i = 0; $i < 10; $i++) {
                $actionTagDelete->setAction($action->getType(), $actionTagDelete->getRandomIds($actions))
                    ->create();

                $actionTagDeletes[] = $actionTagDelete->getId();
                $this->outputSuccess($actionTagDelete->getType(), $actionTagDelete->getId());
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