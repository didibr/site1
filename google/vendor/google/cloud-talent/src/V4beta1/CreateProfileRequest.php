<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/talent/v4beta1/profile_service.proto

namespace Google\Cloud\Talent\V4beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Create profile request.
 *
 * Generated from protobuf message <code>google.cloud.talent.v4beta1.CreateProfileRequest</code>
 */
class CreateProfileRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required.
     * The name of the company this profile belongs to.
     * The format is "projects/{project_id}/companies/{company_id}", for example,
     * "projects/api-test-project/companies/foo".
     *
     * Generated from protobuf field <code>string parent = 1;</code>
     */
    private $parent = '';
    /**
     * Required.
     * The profile to be created.
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.Profile profile = 2;</code>
     */
    private $profile = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           Required.
     *           The name of the company this profile belongs to.
     *           The format is "projects/{project_id}/companies/{company_id}", for example,
     *           "projects/api-test-project/companies/foo".
     *     @type \Google\Cloud\Talent\V4beta1\Profile $profile
     *           Required.
     *           The profile to be created.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Talent\V4Beta1\ProfileService::initOnce();
        parent::__construct($data);
    }

    /**
     * Required.
     * The name of the company this profile belongs to.
     * The format is "projects/{project_id}/companies/{company_id}", for example,
     * "projects/api-test-project/companies/foo".
     *
     * Generated from protobuf field <code>string parent = 1;</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Required.
     * The name of the company this profile belongs to.
     * The format is "projects/{project_id}/companies/{company_id}", for example,
     * "projects/api-test-project/companies/foo".
     *
     * Generated from protobuf field <code>string parent = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setParent($var)
    {
        GPBUtil::checkString($var, True);
        $this->parent = $var;

        return $this;
    }

    /**
     * Required.
     * The profile to be created.
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.Profile profile = 2;</code>
     * @return \Google\Cloud\Talent\V4beta1\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Required.
     * The profile to be created.
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.Profile profile = 2;</code>
     * @param \Google\Cloud\Talent\V4beta1\Profile $var
     * @return $this
     */
    public function setProfile($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Talent\V4beta1\Profile::class);
        $this->profile = $var;

        return $this;
    }

}

