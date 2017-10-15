Feature: items

  Scenario: Request an inexistent controller
    When I request "GET /paymentssss/bill/"
    Then the response code should be "404"

  Scenario: Request an inexistent api method
    When I request "GET /payments/billlll/"
    Then the response code should be "404"
