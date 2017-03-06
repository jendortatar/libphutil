<?php

/**
 * Abstract interface to an identity provider or authentication source, like
 * Twitter, Facebook or Google.
 *
 * Generally, adapters are handed some set of credentials particular to the
 * provider they adapt, and they turn those credentials into standard
 * information about the user's identity. For example, the LDAP adapter is given
 * a username and password (and some other configuration information), uses them
 * to talk to the LDAP server, and produces a username, email, and so forth.
 *
 * Since the credentials a provider requires are specific to each provider, the
 * base adapter does not specify how an adapter should be constructed or
 * configured -- only what information it is expected to be able to provide once
 * properly configured.
 */
abstract class PhutilAuthAdapter extends Phobject
{

  /**
   * Get a unique identifier associated with the identity. For most providers,
   * this is an account ID.
   *
   * The account ID needs to be unique within this adapter's configuration, such
   * that `<adapterKey, accountID>` is globally unique and always identifies the
   * same identity.
   *
   * If the adapter was unable to authenticate an identity, it should return
   * `null`.
   *
   * @return string|null Unique account identifier, or `null` if authentication
   *                     failed.
   */
  abstract public function getAccountID();


  /**
   * Get a string identifying this adapter, like "ldap". This string should be
   * unique to the adapter class.
   *
   * @return string Unique adapter identifier.
   */
  abstract public function getAdapterType();


  /**
   * Get a string identifying the domain this adapter is acting on. This allows
   * an adapter (like LDAP) to act against different identity domains without
   * conflating credentials. For providers like Facebook or Google, the adapters
   * just return the relevant domain name.
   *
   * @return string Domain the adapter is associated with.
   */
  abstract public function getAdapterDomain();


  /**
   * Generate a string uniquely identifying this adapter configuration. Within
   * the scope of a given key, all account IDs must uniquely identify exactly
   * one identity.
   *
   * @return string  Unique identifier for this adapter configuration.
   */
  public function getAdapterKey()
  {
      return $this->getAdapterType().':'.$this->getAdapterDomain();
  }


  /**
   * Optionally, return an email address associated with this account.
   *
   * @return string|null  An email address associated with the account, or
   *                      `null` if data is not available.
   */
  public function getAccountEmail()
  {
      return null;
  }


  /**
   * Optionally, return a human readable username associated with this account.
   *
   * @return string|null  Account username, or `null` if data isn't available.
   */
  public function getAccountName()
  {
      return null;
  }


  /**
   * Optionally, return a URI corresponding to a human-viewable profile for
   * this account.
   *
   * @return string|null  A profile URI associated with this account, or
   *                      `null` if the data isn't available.
   */
  public function getAccountURI()
  {
      return null;
  }


  /**
   * Optionally, return a profile image URI associated with this account.
   *
   * @return string|null  URI for an account profile image, or `null` if one is
   *                      not available.
   */
  public function getAccountImageURI()
  {
      return null;
  }


  /**
   * Optionally, return a real name associated with this account.
   *
   * @return string|null  A human real name, or `null` if this data is not
   *                      available.
   */
  public function getAccountRealName()
  {
      return null;
  }
}
