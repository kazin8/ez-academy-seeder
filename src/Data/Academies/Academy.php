<?php

namespace App\Data\Academies;

use App\Data\Base;
use Zend\Stdlib\ArrayUtils;

class Academy extends Base
{
    const STATUS_PUBLISHED   = 'PUB';
    const STATUS_DRAFT       = 'DRA';

    const TYPE_SINGLE        = 'SNG';
    const TYPE_PACKAGE       = 'PKG';

    const DSGVO_TYPE_SIMPLE  = 'SMP';
    const DSGVO_TYPE_ADVANCE = 'ADV';

    protected $userIdField;
    protected $typeField;
    protected $statusField;
    protected $dsgvoTypeField;
    protected $nameField;
    protected $descriptionField;
    protected $slugField;
    protected $imgField;
    protected $is2fAuthField;
    protected $isAllowRegistrationField;
    protected $isDoiRegistrationField;
    protected $headerLogoField;
    protected $footerLogoField;
    protected $faviconField;
    protected $socialMediaLabelField;
    protected $smtpIdField;
    protected $emailNewUserIdField;
    protected $emailExistUserIdField;
    protected $emailActiveTemplateIdField;
    protected $emailResetTemplateIdField;
    protected $emailChangePasswordTemplateIdField;
    protected $isDsgvoField;
    protected $headerAAlwaysField;
    protected $headerAGeneralField;
    protected $headerAStatField;
    protected $headerAMarkField;
    protected $footerAAlwaysField;
    protected $footerAGeneralField;
    protected $footerAStatField;
    protected $footerAMarkField;
    protected $imprintField;
    protected $privacyPolicyField;
    protected $domainIdField;

    protected $theme;

    protected $user;

    protected $type = 'academies';

    protected function getRelationshipsData() : array
    {
        $result = [];

        if ($theme = $this->getTheme()) {
            $result = ArrayUtils::merge($result, $theme);
        }

        if ($user = $this->getUser()) {
            $result = ArrayUtils::merge($result, $user);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setTheme(string $type, string $id): self
    {
        $this->theme = $this->setOneRelation($type, $id);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $type
     * @param string $id
     * @return self
     */
    public function setUser(string $type, string $id): self
    {
        $this->user = $this->setOneRelation($type, $id);

        return $this;
    }

    protected function getAttributesData() : array
    {
        return [
            'name' => $this->getNameField(),
            'description' => $this->getDescriptionField(),
            'slug' => $this->getSlugField(),
            'img' => $this->getImgField(),
            'is2f-auth' => $this->getIs2fAuthField(),
            'is-allow-registration' => $this->getIsAllowRegistrationField(),
            'is-doi-registration' => $this->getIsDoiRegistrationField(),
            'header-logo' => $this->getHeaderLogoField(),
            'footer-logo' => $this->getFooterLogoField(),
            'favicon' => $this->getFaviconField(),
            'social-media-label' => $this->getSocialMediaLabelField(),
            //'user-id' => $this->getUserIdField(),
            'smtp-id' => $this->getSmtpIdField(),
            'email-new-user-id' => $this->getEmailNewUserIdField(),
            'email-exist-user-id' => $this->getEmailExistUserIdField(),
            'email-activate-template-id' => $this->getEmailActiveTemplateIdField(),
            'email-reset-template-id' => $this->getEmailResetTemplateIdField(),
            'email-change-password-template-id' => $this->getEmailChangePasswordTemplateIdField(),
            'is-dsgvo' => $this->getIsDsgvoField(),
            'dsgvo-type' => $this->getDsgvoTypeField(),
            'header-a-always' => $this->getHeaderAAlwaysField(),
            'header-a-general' => $this->getHeaderAGeneralField(),
            'header-a-stat' => $this->getHeaderAStatField(),
            'header-a-mark' => $this->getHeaderAMarkField(),
            'footer-a-always' => $this->getFooterAAlwaysField(),
            'footer-a-general' => $this->getFooterAGeneralField(),
            'footer-a-stat' => $this->getFooterAStatField(),
            'footer-a-mark' => $this->getFooterAMarkField(),
            'imprint' => $this->getImprintField(),
            'privacy-policy' => $this->getPrivacyPolicyField(),
            'domain-id' => $this->getDomainIdField(),
            'type' => $this->getTypeField(),
            'status' => $this->getStatusField()
        ];
    }


    /**
     * @return mixed
     */
    public function getNameField()
    {
        return $this->nameField ?? $this->faker->sentence(6, true);
    }

    /**
     * @param mixed $nameField
     * @return self
     */
    public function setNameField($nameField): self
    {
        $this->nameField = $nameField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescriptionField()
    {
        return $this->descriptionField ?? $this->faker->realText(500);
    }

    /**
     * @param mixed $descriptionField
     * @return self
     */
    public function setDescriptionField($descriptionField): self
    {
        $this->descriptionField = $descriptionField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlugField()
    {
        return $this->slugField ?? $this->faker->slug(3);
    }

    /**
     * @param mixed $slugField
     * @return self
     */
    public function setSlugField($slugField): self
    {
        $this->slugField = $slugField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImgField()
    {
        return $this->imgField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $imgField
     * @return self
     */
    public function setImgField($imgField): self
    {
        $this->imgField = $imgField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIs2fAuthField()
    {
        return (int) ($this->is2fAuthField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $is2fAuthField
     * @return self
     */
    public function setIs2fAuthField($is2fAuthField): self
    {
        $this->is2fAuthField = $is2fAuthField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsAllowRegistrationField()
    {
        return (int) ($this->isAllowRegistrationField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isAllowRegistrationField
     * @return self
     */
    public function setIsAllowRegistrationField($isAllowRegistrationField): self
    {
        $this->isAllowRegistrationField = $isAllowRegistrationField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsDoiRegistrationField()
    {
        return (int) ($this->isDoiRegistrationField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isDoiRegistrationField
     * @return self
     */
    public function setIsDoiRegistrationField($isDoiRegistrationField): self
    {
        $this->isDoiRegistrationField = $isDoiRegistrationField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaderLogoField()
    {
        return $this->headerLogoField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $headerLogoField
     * @return self
     */
    public function setHeaderLogoField($headerLogoField): self
    {
        $this->headerLogoField = $headerLogoField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFooterLogoField()
    {
        return $this->footerLogoField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $footerLogoField
     * @return self
     */
    public function setFooterLogoField($footerLogoField): self
    {
        $this->footerLogoField = $footerLogoField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFaviconField()
    {
        return $this->faviconField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $faviconField
     * @return self
     */
    public function setFaviconField($faviconField): self
    {
        $this->faviconField = $faviconField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSocialMediaLabelField()
    {
        return $this->socialMediaLabelField ?? $this->faker->sentence(4);
    }

    /**
     * @param mixed $socialMediaLabelField
     * @return self
     */
    public function setSocialMediaLabelField($socialMediaLabelField): self
    {
        $this->socialMediaLabelField = $socialMediaLabelField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmtpIdField()
    {
        return $this->smtpIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $smtpIdField
     * @return self
     */
    public function setSmtpIdField($smtpIdField): self
    {
        $this->smtpIdField = $smtpIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailNewUserIdField()
    {
        return $this->emailNewUserIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $emailNewUserIdField
     * @return self
     */
    public function setEmailNewUserIdField($emailNewUserIdField): self
    {
        $this->emailNewUserIdField = $emailNewUserIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailExistUserIdField()
    {
        return $this->emailExistUserIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $emailExistUserIdField
     * @return self
     */
    public function setEmailExistUserIdField($emailExistUserIdField): self
    {
        $this->emailExistUserIdField = $emailExistUserIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailActiveTemplateIdField()
    {
        return $this->emailActiveTemplateIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $emailActiveTemplateIdField
     * @return self
     */
    public function setEmailActiveTemplateIdField($emailActiveTemplateIdField): self
    {
        $this->emailActiveTemplateIdField = $emailActiveTemplateIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailResetTemplateIdField()
    {
        return $this->emailResetTemplateIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $emailResetTemplateIdField
     * @return self
     */
    public function setEmailResetTemplateIdField($emailResetTemplateIdField): self
    {
        $this->emailResetTemplateIdField = $emailResetTemplateIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailChangePasswordTemplateIdField()
    {
        return $this->emailChangePasswordTemplateIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $emailChangePasswordTemplateIdField
     * @return self
     */
    public function setEmailChangePasswordTemplateIdField($emailChangePasswordTemplateIdField): self
    {
        $this->emailChangePasswordTemplateIdField = $emailChangePasswordTemplateIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsDsgvoField()
    {
        return (int) ($this->isDsgvoField ?? $this->faker->boolean());
    }

    /**
     * @param mixed $isDsgvoField
     * @return self
     */
    public function setIsDsgvoField($isDsgvoField): self
    {
        $this->isDsgvoField = $isDsgvoField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaderAAlwaysField()
    {
        return $this->headerAAlwaysField ?? $this->faker->text();
    }

    /**
     * @param mixed $headerAAlwaysField
     * @return self
     */
    public function setHeaderAAlwaysField($headerAAlwaysField): self
    {
        $this->headerAAlwaysField = $headerAAlwaysField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaderAGeneralField()
    {
        return $this->headerAGeneralField ?? $this->faker->text();
    }

    /**
     * @param mixed $headerAGeneralField
     * @return self
     */
    public function setHeaderAGeneralField($headerAGeneralField): self
    {
        $this->headerAGeneralField = $headerAGeneralField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaderAStatField()
    {
        return $this->headerAStatField ?? $this->faker->text();
    }

    /**
     * @param mixed $headerAStatField
     * @return self
     */
    public function setHeaderAStatField($headerAStatField): self
    {
        $this->headerAStatField = $headerAStatField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaderAMarkField()
    {
        return $this->headerAMarkField ?? $this->faker->text();
    }

    /**
     * @param mixed $headerAMarkField
     * @return self
     */
    public function setHeaderAMarkField($headerAMarkField): self
    {
        $this->headerAMarkField = $headerAMarkField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFooterAAlwaysField()
    {
        return $this->footerAAlwaysField ?? $this->faker->text();
    }

    /**
     * @param mixed $footerAAlwaysField
     * @return self
     */
    public function setFooterAAlwaysField($footerAAlwaysField): self
    {
        $this->footerAAlwaysField = $footerAAlwaysField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFooterAGeneralField()
    {
        return $this->footerAGeneralField ?? $this->faker->text();
    }

    /**
     * @param mixed $footerAGeneralField
     * @return self
     */
    public function setFooterAGeneralField($footerAGeneralField): self
    {
        $this->footerAGeneralField = $footerAGeneralField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFooterAStatField()
    {
        return $this->footerAStatField ?? $this->faker->text();
    }

    /**
     * @param mixed $footerAStatField
     * @return self
     */
    public function setFooterAStatField($footerAStatField): self
    {
        $this->footerAStatField = $footerAStatField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFooterAMarkField()
    {
        return $this->footerAMarkField ?? $this->faker->text();
    }

    /**
     * @param mixed $footerAMarkField
     * @return self
     */
    public function setFooterAMarkField($footerAMarkField): self
    {
        $this->footerAMarkField = $footerAMarkField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImprintField()
    {
        return $this->imprintField ?? $this->faker->realText();
    }

    /**
     * @param mixed $imprintField
     * @return self
     */
    public function setImprintField($imprintField): self
    {
        $this->imprintField = $imprintField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrivacyPolicyField()
    {
        return $this->privacyPolicyField ?? $this->faker->realText(400);
    }

    /**
     * @param mixed $privacyPolicyField
     * @return self
     */
    public function setPrivacyPolicyField($privacyPolicyField): self
    {
        $this->privacyPolicyField = $privacyPolicyField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDomainIdField()
    {
        return $this->domainIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $domainIdField
     * @return self
     */
    public function setDomainIdField($domainIdField): self
    {
        $this->domainIdField = $domainIdField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeField()
    {
        return $this->typeField ?? self::TYPE_SINGLE;
    }

    /**
     * @param mixed $typeField
     * @return self
     */
    public function setTypeField($typeField) : self
    {
        $this->typeField = $typeField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusField()
    {
        return $this->statusField ?? self::STATUS_PUBLISHED;
    }

    /**
     * @param mixed $statusField
     * @return self
     */
    public function setStatusField($statusField) : self
    {
        $this->statusField = $statusField;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsgvoTypeField()
    {
        return $this->dsgvoTypeField ?? self::DSGVO_TYPE_SIMPLE;
    }

    /**
     * @param mixed $dsgvoTypeField
     * @return self
     */
    public function setDsgvoTypeField($dsgvoTypeField) : self
    {
        $this->dsgvoTypeField = $dsgvoTypeField;

        return $this;
    }

    public function getUserIdField()
    {
        return $this->userIdField ?? $this->faker->uuid;
    }

    /**
     * @param mixed $userIdField
     * @return self
     */
    public function setUserIdField($userIdField) : self
    {
        $this->userIdField = $userIdField;

        return $this;
    }
}