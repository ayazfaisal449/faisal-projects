<?php

class ExampleTest extends TestCase {

	/**
	 * Group Manage example.
	 *
	 * @return void
	 */
	public function testGroupManage()
	{
		$crawler = $this->client->request('GET', 'admin/group');

		$this->assertTrue($this->client->getResponse()->isOk());
	}
	
	/**
	 * Users Manage example.
	 *
	 * @return void
	 */
	public function testUsersManage()
	{
		$crawler = $this->client->request('GET', 'admin/users');

		$this->assertTrue($this->client->getResponse()->isOk());
	}
	
	/**
	 * Permission Manage example.
	 *
	 * @return void
	 */
	public function testPermissionManage()
	{
		$crawler = $this->client->request('GET', 'admin/permission');

		$this->assertTrue($this->client->getResponse()->isOk());
	}
	
}