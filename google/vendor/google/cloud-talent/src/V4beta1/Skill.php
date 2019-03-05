<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/talent/v4beta1/profile.proto

namespace Google\Cloud\Talent\V4beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Resource that represents a skill of a candidate.
 *
 * Generated from protobuf message <code>google.cloud.talent.v4beta1.Skill</code>
 */
class Skill extends \Google\Protobuf\Internal\Message
{
    /**
     * Optional.
     * Skill display name.
     * For example, "Java", "Python".
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string display_name = 1;</code>
     */
    private $display_name = '';
    /**
     * Optional.
     * The last time this skill was used.
     *
     * Generated from protobuf field <code>.google.type.Date last_used_date = 2;</code>
     */
    private $last_used_date = null;
    /**
     * Optional.
     * Skill proficiency level which indicates how proficient the candidate is at
     * this skill.
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.Skill.SkillProficiencyLevel level = 3;</code>
     */
    private $level = 0;
    /**
     * Optional.
     * A paragraph describes context of this skill.
     * Number of characters allowed is 100,000.
     *
     * Generated from protobuf field <code>string context = 4;</code>
     */
    private $context = '';
    /**
     * Output only. Skill name snippet shows how the [display_name][google.cloud.talent.v4beta1.Skill.display_name] is related
     * to a search query. It's empty if the [display_name][google.cloud.talent.v4beta1.Skill.display_name] isn't related to the
     * search query.
     *
     * Generated from protobuf field <code>string skill_name_snippet = 5;</code>
     */
    private $skill_name_snippet = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $display_name
     *           Optional.
     *           Skill display name.
     *           For example, "Java", "Python".
     *           Number of characters allowed is 100.
     *     @type \Google\Type\Date $last_used_date
     *           Optional.
     *           The last time this skill was used.
     *     @type int $level
     *           Optional.
     *           Skill proficiency level which indicates how proficient the candidate is at
     *           this skill.
     *     @type string $context
     *           Optional.
     *           A paragraph describes context of this skill.
     *           Number of characters allowed is 100,000.
     *     @type string $skill_name_snippet
     *           Output only. Skill name snippet shows how the [display_name][google.cloud.talent.v4beta1.Skill.display_name] is related
     *           to a search query. It's empty if the [display_name][google.cloud.talent.v4beta1.Skill.display_name] isn't related to the
     *           search query.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Talent\V4Beta1\Profile::initOnce();
        parent::__construct($data);
    }

    /**
     * Optional.
     * Skill display name.
     * For example, "Java", "Python".
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string display_name = 1;</code>
     * @return string
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * Optional.
     * Skill display name.
     * For example, "Java", "Python".
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string display_name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setDisplayName($var)
    {
        GPBUtil::checkString($var, True);
        $this->display_name = $var;

        return $this;
    }

    /**
     * Optional.
     * The last time this skill was used.
     *
     * Generated from protobuf field <code>.google.type.Date last_used_date = 2;</code>
     * @return \Google\Type\Date
     */
    public function getLastUsedDate()
    {
        return $this->last_used_date;
    }

    /**
     * Optional.
     * The last time this skill was used.
     *
     * Generated from protobuf field <code>.google.type.Date last_used_date = 2;</code>
     * @param \Google\Type\Date $var
     * @return $this
     */
    public function setLastUsedDate($var)
    {
        GPBUtil::checkMessage($var, \Google\Type\Date::class);
        $this->last_used_date = $var;

        return $this;
    }

    /**
     * Optional.
     * Skill proficiency level which indicates how proficient the candidate is at
     * this skill.
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.Skill.SkillProficiencyLevel level = 3;</code>
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Optional.
     * Skill proficiency level which indicates how proficient the candidate is at
     * this skill.
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.Skill.SkillProficiencyLevel level = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setLevel($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Talent\V4beta1\Skill_SkillProficiencyLevel::class);
        $this->level = $var;

        return $this;
    }

    /**
     * Optional.
     * A paragraph describes context of this skill.
     * Number of characters allowed is 100,000.
     *
     * Generated from protobuf field <code>string context = 4;</code>
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Optional.
     * A paragraph describes context of this skill.
     * Number of characters allowed is 100,000.
     *
     * Generated from protobuf field <code>string context = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setContext($var)
    {
        GPBUtil::checkString($var, True);
        $this->context = $var;

        return $this;
    }

    /**
     * Output only. Skill name snippet shows how the [display_name][google.cloud.talent.v4beta1.Skill.display_name] is related
     * to a search query. It's empty if the [display_name][google.cloud.talent.v4beta1.Skill.display_name] isn't related to the
     * search query.
     *
     * Generated from protobuf field <code>string skill_name_snippet = 5;</code>
     * @return string
     */
    public function getSkillNameSnippet()
    {
        return $this->skill_name_snippet;
    }

    /**
     * Output only. Skill name snippet shows how the [display_name][google.cloud.talent.v4beta1.Skill.display_name] is related
     * to a search query. It's empty if the [display_name][google.cloud.talent.v4beta1.Skill.display_name] isn't related to the
     * search query.
     *
     * Generated from protobuf field <code>string skill_name_snippet = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setSkillNameSnippet($var)
    {
        GPBUtil::checkString($var, True);
        $this->skill_name_snippet = $var;

        return $this;
    }

}

