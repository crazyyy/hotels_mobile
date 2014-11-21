<?php
/*
 * This file is part of the Hotels24.ua project.
 *
 * (c) Hotels24.ua 2007-2014
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 *  
 */
class BookingHelper {

    /**
     * @param CHttpRequest $request
     * @return array
     */
    public static function getBookingDataFromRequest(CHttpRequest $request) {
        $firstName = $request->getParam('firstName');
        $email = $request->getParam('email');

        $hotelName = $request->getParam('hotelName');
        $hotelType = $request->getParam('hotelType');

        $bookingId = $request->getParam('bookingId');

        return [
                'firstName' => $firstName,
                'email' => $email,
                'hotelName' => $hotelName,
                'hotelType' => $hotelType,
                'bookingId' => $bookingId
            ];
    }

    /**
     * @param object $booking
     * @param array $hotelData
     * @param integer $bookingId
     * @return array
     */
    public static function getBookingDataForRequest($booking, $hotelData, $bookingId) {
        return http_build_str([
            'firstName' => $booking->firstName,
            'email' => $booking->email,
            'bookingId' => $bookingId,
            'hotelType' => $hotelData['hotel_type_locative'],
            'hotelName' => $hotelData['hotel_name']
        ]);
    }

} 