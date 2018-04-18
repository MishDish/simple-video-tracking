
/*
 *
 *   @file Manages client side for sending events to server
 *   @author Misha Vucicevic
 *   NOTE : It is created in ES6 javascript 
 *
 */

$(document).ready(() => {

    console.log("JS ASSET LOADED");

    const SERVER_URL = "http://localhost/test_php/logEvents.php"; // "https://ourServer.com/events/logEvents.php";

    let isFullView = false;

    const customerName = "customer1";

    // create random page session

    function getPageSession() {
        return `${customerName}${new Date().getTime()}  "  " ${Math.floor((Math.random() * 998) + 1)}`;
    }

    // prepare body for the request

    function prepareEventData(videoId) {
        const timeInMs = Date.now();
        return {
            time: timeInMs,
            page_session: getPageSession(),
            action: "inView",
            elementId: videoId,
            page_url: window.location.href
        }
    }

    // communicate with server script

    function logEventInServer(videoId) {

        const jsonData = prepareEventData(videoId);

        $.ajax({
            type: "POST",
            url: SERVER_URL,
            dataType: 'json',
            data: { viewChanged: JSON.stringify(jsonData) },
            success: (response) => {
                console.log("SUCCESS");
            },
            error: (err) => {
                console.log("Failed ", err);
            }
        }).done((msg) => {
            console.log("Data Saved: ", msg);
        });
    }

    function changeVideoViewHandler(event) {
        const videoId = event.path[1] ? event.path[1].id : null;
        isFullView = !isFullView;

        if (!isFullView)
            return;

        logEventInServer(videoId);
    }
    document.addEventListener("fullscreenchange", changeVideoViewHandler, false);
    document.addEventListener("webkitfullscreenchange", changeVideoViewHandler, false);
    document.addEventListener("mozfullscreenchange", changeVideoViewHandler, false);
});

