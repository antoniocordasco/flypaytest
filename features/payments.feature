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