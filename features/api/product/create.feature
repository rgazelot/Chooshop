Feature: foo

Scenario: foo
  Given I use the token "72bd56d223ba5baf5b7077101228e1883f720cd3"
  When I send a POST request to "/products" with body:
  """
  {"foo": "bar"}
  """
  Then print response
