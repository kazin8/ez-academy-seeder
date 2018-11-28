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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ActionRegistration extends Command
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

        $this->setName('action-registration')
            ->setDescription('This command seed data to server for ez-academy service')
            ->setHelp('This command seed data to server for ez-academy service')
            ->addArgument('academy', InputArgument::REQUIRED, 'Academy ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $academyId = $input->getArgument('academy');
        $starttime = microtime(true);

        $this->output = $output;

        $action = new Action($this->config);
        $actionTagAdd = new ActionTagAdd($this->config);
        $actionTagDelete = new ActionTagDelete($this->config);

        try {

            $action
                ->setAcademy('academies', $academyId)
                ->setTriggerField(Action::TRIGGER_REGISTRATION)
                ->setActionTypeField(Action::ACTION_TYPE_EMAIL)
                ->setIsActiveField(1)
                ->create();

            $this->outputSuccess($action->getType().' single', $action->getId());

            $action
                ->setAcademy('academies', $academyId)
                ->setTriggerField(Action::TRIGGER_REGISTRATION)
                ->setActionTypeField(Action::ACTION_TYPE_KLICK_TIPP)
                ->setAccountIdField('5ca2f946-6420-4fad-b60f-e283ce8ab6c2')
                ->setIsActiveField(1)
                ->setListIdField('132648')
                ->create();

            $actionTagAdd->setAction($action->getType(), $action->getId())
                ->create();
            $this->outputSuccess($actionTagAdd->getType().' single', $actionTagAdd->getId());
            $actionTagAdd->setAction($action->getType(), $action->getId())
                ->create();
            $this->outputSuccess($actionTagAdd->getType().' single', $actionTagAdd->getId());

            $actionTagDelete->setAction($action->getType(), $action->getId())
                ->create();
            $this->outputSuccess($actionTagDelete->getType().' single', $actionTagDelete->getId());
            $actionTagDelete->setAction($action->getType(), $action->getId())
                ->create();
            $this->outputSuccess($actionTagDelete->getType().' single', $actionTagDelete->getId());

            $this->outputSuccess($action->getType().' single', $action->getId());

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