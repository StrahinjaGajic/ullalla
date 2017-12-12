<?php 
namespace Acme\Billing;

interface BillingInterface {
	public function createCustomer();
	public function charge($data = []);	
}