Feature: Related to the product API
  Delete a product

Scenario: Delete a product
  Given I use the token "myBehatToken"
  When I send a DELETE request to "/products/1"
  Then the response code should be 204
