<?php

/**
 * @group BagOStuff
 * @group Database
 * @covers SqlBagOStuff
 */
class SqlBagOStuffMultiMysqlIntegrationTest extends BagOStuffTestBase {
	protected function setUp(): void {
		parent::setUp();

		$this->markTestSkippedIfDbType( 'mysql' );
	}

	protected function newCacheInstance() {
		return ObjectCache::newFromParams( [
			'class' => SqlBagOStuff::class,
			'loggroup' => 'SQLBagOStuff',
			'globalKeyLb' => [
				'factory' => static function () {
					return \Mediawiki\MediaWikiServices::getInstance()->getDBLoadBalancer();
				}
			],
			'globalKeyLbDomain' => WikiMap::getCurrentWikiDbDomain()->getId(),
			'multiPrimaryMode' => true,
			'purgePeriod' => 0,
			'reportDupes' => false
		] );
	}
}
