Feature: payments

  Scenario: Get the bill
    Given that "three burgers have been ordered"
    When I request "GET /payments/bill"
    Then I should get:
            """
            {
              "total": 30,
              "toPay": 30
          }
            """

  Scenario: Make a payment
    Given that "three burgers have been ordered"
    When I request "GET /payments/pay/?amount=10"
    Then I should get:
            """
            {
              "total": 30,
              "toPay": 20
          }
            """

  Scenario: Get the bill when a payment has been made
    Given that "three burgers have been ordered and one of them has been paid"
    When I request "GET /payments/bill"
    Then I should get:
            """
            {
              "total": 30,
              "toPay": 20
          }
            """