Feature: items

  Scenario: List all items
    Given there are three items in the menu
    When I request "GET /items/list"
    Then I should get:
            """
            {
              "1": {
                  "id": 1,
                  "name": "Salad",
                  "price": 7,
                  "available": true
              },
              "2": {
                  "id": 2,
                  "name": "Hamburger",
                  "price": 10,
                  "available": true
              },
              "3": {
                  "id": 3,
                  "name": "Chips",
                  "price": 3,
                  "available": true
              }
          }
            """

  Scenario: Order an item that is available
    Given burgers are available
    When I request "GET /items/orderItem/?id=2&quantity=3"
    Then I should get:
            """
            3
            """

  Scenario: Order an item that is not available
    Given burgers are not available
    When I request "GET /items/orderItem/?id=2&quantity=3"
    Then the response code should be "403"