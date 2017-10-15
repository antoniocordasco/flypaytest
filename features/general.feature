Feature: items

  Scenario: Request an inexistent controller
    When I request "GET /paymentssss/bill/"
    Then the response code should be "404"

  Scenario: Request an inexistent api method
    When I request "GET /payments/billlll/"
    Then the response code should be "404"

  Scenario: Make request without trailing slash and with arguments
    Given that "burgers are available"
    When I request "GET /items/orderItem?id=2&quantity=3"
    Then I should get:
            """
            {"itemsOrdered": 3}
            """
