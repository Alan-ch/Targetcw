<?php
// Challenge: refactor these interfaces into a more sensible architecture (adding new interfaces where required)
interface FlightBookingSystemInterface
{   public function getAllAirports();
    public function bookFlight(AirportInterface $origin, AirportInterface $destination, UserInterface $user, $time, AirlineInterface $airline);
}
interface AirportInterface {
  public function getPossibleDestinationAirportsForOriginAirport();
  public function getDepartureTimes(AirportInterface $destination);
}
interface UserInterface {}
interface AirlineInterface {
  public function getFlightCost(AirportInterface $origin, AirportInterface $destination, $time);
}
