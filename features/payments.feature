Feature: payments

  Scenario: Get the bill
    Given that "three burgers have been ordered"
    When I request "GET /payments/bill"
    Then I should get:
            """
            {
              "total": 30,
              "toPay": 30,
              "closed": false,
              "tip": 0
          }
            """

  Scenario: Make a payment
    Given that "three burgers have been ordered"
    When I request "GET /payments/pay/?amount=10"
    Then I should get:
            """
            {
              "total": 30,
              "toPay": 20,
              "closed": false,
              "tip": 0
          }
            """

  Scenario: Get the bill when a payment has been made
    Given that "three burgers have been ordered and one of them has been paid"
    When I request "GET /payments/bill"
    Then I should get:
            """
            {
              "total": 30,
              "toPay": 20,
              "closed": false,
              "tip": 0
          }
            """

  Scenario: Get the bill when it has been fully paid with no tip
    Given that "one burger has been ordered and paid"
    When I request "GET /payments/bill"
    Then I should get:
            """
            {
              "total": 10,
              "toPay": 0,
              "closed": true,
              "tip": 0
          }
            """

  Scenario: Get the bill when it has been fully paid with tip
    Given that "one burger has been ordered and paid plus tip"
    When I request "GET /payments/bill"
    Then I should get:
            """
            {
              "total": 10,
              "toPay": 0,
              "closed": true,
              "tip": 2
          }
            """