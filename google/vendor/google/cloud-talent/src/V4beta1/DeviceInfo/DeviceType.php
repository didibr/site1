<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/talent/v4beta1/common.proto

namespace Google\Cloud\Talent\V4beta1\DeviceInfo;

/**
 * An enumeration describing an API access portal and exposure mechanism.
 *
 * Protobuf type <code>google.cloud.talent.v4beta1.DeviceInfo.DeviceType</code>
 */
class DeviceType
{
    /**
     * The device type isn't specified.
     *
     * Generated from protobuf enum <code>DEVICE_TYPE_UNSPECIFIED = 0;</code>
     */
    const DEVICE_TYPE_UNSPECIFIED = 0;
    /**
     * A desktop web browser, such as, Chrome, Firefox, Safari, or Internet
     * Explorer)
     *
     * Generated from protobuf enum <code>WEB = 1;</code>
     */
    const WEB = 1;
    /**
     * A mobile device web browser, such as a phone or tablet with a Chrome
     * browser.
     *
     * Generated from protobuf enum <code>MOBILE_WEB = 2;</code>
     */
    const MOBILE_WEB = 2;
    /**
     * An Android device native application.
     *
     * Generated from protobuf enum <code>ANDROID = 3;</code>
     */
    const ANDROID = 3;
    /**
     * An iOS device native application.
     *
     * Generated from protobuf enum <code>IOS = 4;</code>
     */
    const IOS = 4;
    /**
     * A bot, as opposed to a device operated by human beings, such as a web
     * crawler.
     *
     * Generated from protobuf enum <code>BOT = 5;</code>
     */
    const BOT = 5;
    /**
     * Other devices types.
     *
     * Generated from protobuf enum <code>OTHER = 6;</code>
     */
    const OTHER = 6;
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DeviceType::class, \Google\Cloud\Talent\V4beta1\DeviceInfo_DeviceType::class);

