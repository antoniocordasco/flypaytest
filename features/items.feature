Feature: items

  Scenario: List all items
    Given that "there are three items in the menu"
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
    Given that "burgers are available"
    When I request "GET /items/orderItem/?id=2&quantity=3"
    Then I should get:
            """
            {"itemsOrdered": 3}
            """

  Scenario: Order an item that is not available
    Given that "burgers are not available"
    When I request "GET /items/orderItem/?id=2&quantity=3"
    Then the response code should be "403"

  Scenario: Cancel item before any payments
    Given that "two chips have been ordered without any payments being made"
    When I request "GET /items/cancelItem/?id=3&quantity=1"
    Then I should get:
            """
            {"itemsOrdered": 1}
            """

  Scenario: Cancel item after payment
    Given that "two chips have been ordered and a payment has been made"
    When I request "GET /items/cancelItem/?id=3&quantity=1"
    Then the response code should be "403"

  Scenario: Cancel item that has not been ordered
    Given that "nothing has been ordered"
    When I request "GET /items/cancelItem/?id=3&quantity=1"
    Then the response code should be "403"

  Scenario: Cancel all items before any payments
    Given that "two chips have been ordered without any payments being made and all get cancelled"
    When I request "GET /items/cancelAllItems/"
    Then I should get:
            """
            {"itemsOrdered": 0}
            """

  Scenario: Cancel item after payment
    Given that "two chips have been ordered and a payment has been made"
    When I request "GET /items/cancelAllItems/"
    Then the response code should be "403"