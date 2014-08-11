Feature: Related to the product API
  Fetch one or a collection of products

Scenario: Fetch a collection
  Given I use the token "thomasBehatToken"
  When I send a GET request to "/products"
  Then the response code should be 200

Scenario: When a product isn't found
  Given I use the token "thomasBehatToken"
  When I send a GET request to "/products/999999999999"
  Then the response code should be 404
    And the response should contain json:
    """
    {"code":404,"message":"Product with the id 999999999999 not found"}
    """

Scenario: When I try to fetch the product of another house
  Given I use the token "thomasBehatToken"
  When I send a GET request to "/products/13"
  Then the response code should be 404
    And the response should contain json:
    """
    {"code":404,"message":"Product with the id 13 not found"}
    """

Scenario: Fetch a product
  Given I use the token "thomasBehatToken"
  When I send a GET request to "/products/2"
  Then the response code should be 200
