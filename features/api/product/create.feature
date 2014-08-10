Feature: Related to the product API
  The creation of product

Scenario: Create product without a mandatory parameter
  Given I use the token "myBehatToken"
  When I send a POST request to "/products" with body:
  """
  {"priority": 1}
  """
  Then the response code should be 400

Scenario: Create product without a mandatory parameter
  Given I use the token "myBehatToken"
  When I send a POST request to "/products" with body:
  """
  {"name": "foo"}
  """
  Then the response code should be 400

Scenario: Create a product
  Given I use the token "myBehatToken"
  When I send a POST request to "/products" with body:
  """
  {
    "name": "Tomatoes",
    "priority": 1,
    "description": "Italian tomatoes"
  }
  """
  Then the response code should be 200
