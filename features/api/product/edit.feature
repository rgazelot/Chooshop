Feature: Related to the product API
  Edit a product

Scenario: Edit a product
  Given I use the token "myBehatToken"
  When I send a PUT request to "/products/2" with body:
  """
  {"name":"product edited", "priority": 3, "description": "description edited"}
  """
  Then the response code should be 200
