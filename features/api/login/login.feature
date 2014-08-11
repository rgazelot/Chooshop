Feature: Related to the login with a token
    All endpoint of the API need a token

Scenario: Try to retrieve a Product with an invalid token
  Given I use the token "foo"
  When I send a GET request to "/products"
  Then the response code should be 404
    And the response should contain json:
    """
    {"code":404,"message":"User not found"}
    """
