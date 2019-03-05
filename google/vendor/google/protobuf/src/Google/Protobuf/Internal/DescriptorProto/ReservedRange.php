<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/descriptor.proto

namespace Google\Protobuf\Internal\DescriptorProto;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\GPBWire;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\InputStream;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Range of reserved tag numbers. Reserved tag numbers may not be used by
 * fields or extension ranges in the same message. Reserved ranges may
 * not overlap.
 *
 * Generated from protobuf message <code>google.protobuf.DescriptorProto.ReservedRange</code>
 */
class ReservedRange extends \Google\Protobuf\Internal\Message
{
    /**
     * Inclusive.
     *
     * Generated from protobuf field <code>optional int32 start = 1;</code>
     */
    private $start = 0;
    private $has_start = false;
    /**
     * Exclusive.
     *
     * Generated from protobuf field <code>optional int32 end = 2;</code>
     */
    private $end = 0;
    private $has_end = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $start
     *           Inclusive.
     *     @type int $end
     *           Exclusive.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Protobuf\Internal\Descriptor::initOnce();
        parent::__construct($data);
    }

    /**
     * Inclusive.
     *
     * Generated from protobuf field <code>optional int32 start = 1;</code>
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Inclusive.
     *
     * Generated from protobuf field <code>optional int32 start = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setStart($var)
    {
        GPBUtil::checkInt32($var);
        $this->start = $var;
        $this->has_start = true;

        return $this;
    }

    public function hasStart()
    {
        return $this->has_start;
    }

    /**
     * Exclusive.
     *
     * Generated from protobuf field <code>optional int32 end = 2;</code>
     * @return int
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Exclusive.
     *
     * Generated from protobuf field <code>optional int32 end = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setEnd($var)
    {
        GPBUtil::checkInt32($var);
        $this->end = $var;
        $this->has_end = true;

        return $this;
    }

    public function hasEnd()
    {
        return $this->has_end;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ReservedRange::class, \Google\Protobuf\Internal\DescriptorProto_ReservedRange::class);

