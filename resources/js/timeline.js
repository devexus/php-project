var JQTL_VER = $.fn.Timeline ? $.fn.Timeline.Constructor.VERSION : "2.1.x",
    JQUERY_VER = "3.5.1",
    tlElem = $("#timeline"), // Cached timeline element
    now = new Date(),
    listItems = [],
    incr = 1,
    maxList = 12, // display max rows of sidebar
    begin = now.setDate(now.getDate() - 3),
    end = undefined;
now.setMonth(now.getMonth() + 2);
end = now.setDate(now.getDate() - 1);
for (incr = 1; incr <= maxList; incr++) {
    listItems.push("<span>Row " + incr + "</span>");
}

// Timeline options are defined as global variables
window.tlOpts = {
    type: "mixed",
    startDatetime: begin,
    endDatetime: end,
    scale: "day",
    minGridSize: 48,
    headline: {
        display: true,
        title:
            '<i class="jqtl-icon mr-h"></i>jQuery.Timeline ' +
            JQTL_VER +
            " via jQuery " +
            JQUERY_VER,
        range: true,
        local: "en-US",
        format: {
            timeZone: "UTC",
            hour12: false,
        },
    },
    sidebar: {
        list: listItems,
        sticky: true,
    },
    rows: listItems.length,
    ruler: {
        top: {
            lines: ["year", "month", "day"],
            format: {
                year: "numeric",
                month: "long",
                day: "numeric",
            },
        },
        bottom: {
            lines: ["day"],
            format: {
                day: "numeric",
            },
        },
    },
    hideScrollbar: true,
    eventData: generateEventData(begin, end), // Generate initial event data
};

// Initialize the timeline
tlElem.Timeline(window.tlOpts);

function getDateArray(date) {
    // Helper to get each elements of Date object as an array
    var _dt = date instanceof Date ? date : new Date(date);
    return [
        _dt.getFullYear(),
        _dt.getMonth(),
        _dt.getDate(),
        _dt.getHours(),
        _dt.getMinutes(),
        _dt.getSeconds(),
        _dt.getMilliseconds(),
    ];
}
function getDateString(date) {
    // Helper to get Date object as a string of "Y-m-d H:i:s" format
    var _dt = getDateArray(date);
    // return `${_dt[0]}-${_dt[1] + 1}-${_dt[2]} ${_dt[3]}:${_dt[4]}:${_dt[5]}`;
    return (
        _dt[0] +
        "-" +
        (_dt[1] + 1) +
        "-" +
        _dt[2] +
        " " +
        _dt[3] +
        ":" +
        _dt[4] +
        ":" +
        _dt[5]
    );
}
function getModDateString(date, mods) {
    // Helper to get the date string after updating the date with the specified amount time.
    var baseDt =
            date instanceof Date ? new Date(date.getTime()) : new Date(date),
        getRandomInt = function (min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min)) + min;
        },
        found;
    if (mods && typeof mods === "object") {
        for (var _key in mods) {
            found = null;
            switch (true) {
                case /^y(|ears?)$/i.test(_key):
                    if (
                        typeof mods[_key] === "string" &&
                        /^(-|\+)\d+$/i.test(mods[_key])
                    ) {
                        found = mods[_key].match(/^(-|\+)(\d+)$/);
                        if (found[1] === "-") {
                            baseDt.setFullYear(
                                baseDt.getFullYear() - Number(found[2])
                            );
                        } else {
                            baseDt.setFullYear(
                                baseDt.getFullYear() + Number(found[2])
                            );
                        }
                    } else if ("rand" === mods[_key]) {
                        baseDt.setFullYear(
                            getRandomInt(1, new Date().getFullYear())
                        );
                    } else {
                        baseDt.setFullYear(Number(mods[_key]));
                    }
                    break;
                case /^mon(|ths?)$/i.test(_key):
                    if (
                        typeof mods[_key] === "string" &&
                        /^(-|\+)\d+$/i.test(mods[_key])
                    ) {
                        found = mods[_key].match(/^(-|\+)(\d+)$/);
                        if (found[1] === "-") {
                            baseDt.setMonth(
                                baseDt.getMonth() - Number(found[2])
                            );
                        } else {
                            baseDt.setMonth(
                                baseDt.getMonth() + Number(found[2])
                            );
                        }
                    } else if ("rand" === mods[_key]) {
                        baseDt.setMonth(getRandomInt(0, 11));
                    } else {
                        baseDt.setMonth(
                            Number(mods[_key]) == 12 ? 11 : Number(mods[_key])
                        );
                    }
                    break;
                case /^d(|ays?)$/i.test(_key):
                    if (
                        typeof mods[_key] === "string" &&
                        /^(-|\+)\d+$/i.test(mods[_key])
                    ) {
                        found = mods[_key].match(/^(-|\+)(\d+)$/);
                        if (found[1] === "-") {
                            baseDt.setDate(baseDt.getDate() - Number(found[2]));
                        } else {
                            baseDt.setDate(baseDt.getDate() + Number(found[2]));
                        }
                    } else if ("rand" === mods[_key]) {
                        baseDt.setDate(getRandomInt(1, 31));
                    } else {
                        baseDt.setDate(Number(mods[_key]));
                    }
                    break;
                case /^h(|ours?)$/i.test(_key):
                    if (
                        typeof mods[_key] === "string" &&
                        /^(-|\+)\d+$/i.test(mods[_key])
                    ) {
                        found = mods[_key].match(/^(-|\+)(\d+)$/);
                        if (found[1] === "-") {
                            baseDt.setHours(
                                baseDt.getHours() - Number(found[2])
                            );
                        } else {
                            baseDt.setHours(
                                baseDt.getHours() + Number(found[2])
                            );
                        }
                    } else if ("rand" === mods[_key]) {
                        baseDt.setHours(getRandomInt(0, 23));
                    } else {
                        baseDt.setHours(Number(mods[_key]));
                    }
                    break;
                case /^min(|utes?)$/i.test(_key):
                    if (
                        typeof mods[_key] === "string" &&
                        /^(-|\+)\d+$/i.test(mods[_key])
                    ) {
                        found = mods[_key].match(/^(-|\+)(\d+)$/);
                        if (found[1] === "-") {
                            baseDt.setMinutes(
                                baseDt.getMinutes() - Number(found[2])
                            );
                        } else {
                            baseDt.setMinutes(
                                baseDt.getMinutes() + Number(found[2])
                            );
                        }
                    } else if ("rand" === mods[_key]) {
                        baseDt.setMinutes(getRandomInt(0, 59));
                    } else {
                        baseDt.setMinutes(Number(mods[_key]));
                    }
                    break;
                case /^s(|(ec|onds?))$/i.test(_key):
                    if (
                        typeof mods[_key] === "string" &&
                        /^(-|\+)\d+$/i.test(mods[_key])
                    ) {
                        found = mods[_key].match(/^(-|\+)(\d+)$/);
                        if (found[1] === "-") {
                            baseDt.setSeconds(
                                baseDt.getSeconds() - Number(found[2])
                            );
                        } else {
                            baseDt.setSeconds(
                                baseDt.getSeconds() + Number(found[2])
                            );
                        }
                    } else if ("rand" === mods[_key]) {
                        baseDt.setSeconds(getRandomInt(0, 59));
                    } else {
                        baseDt.setSeconds(Number(mods[_key]));
                    }
                    break;
                default:
                    break;
            }
        }
    }
    return getDateString(baseDt);
}
function createEvents(num) {
    // Helper to randomly generate a specified number of events
    var nowDt = new Date(),
        _evts = [],
        _max = num || 1,
        _startDt,
        _endDt,
        _row,
        i;

    for (i = 0; i < _max; i++) {
        _startDt = getDateString(
            nowDt.setDate(
                nowDt.getDate() + (Math.floor(Math.random() * 10) + 1)
            )
        );
        _endDt = getDateString(
            nowDt.getTime() +
                (Math.floor(Math.random() * 7) + 1) * 24 * 60 * 60 * 1000
        );
        _row = Math.floor(Math.random() * 12) + 1;
        _evts.push({
            start: _startDt,
            end: _endDt,
            row: _row,
            label: "Created new event (" + (i + 1) + ")",
            content: "This is an event added by the addEvent method.",
        });
    }
    return _evts;
}
function generateEventData(begin, end) {
    // Generate an initial event nodes for the timeline.
    var events = [
        {
            start: getModDateString(begin, {
                day: "+5",
                h: 12,
                min: 34,
                sec: 56,
            }),
            end: getModDateString(begin, {
                day: "+12",
                h: 15,
                min: 43,
                sec: 21,
            }),
            row: 1,
            content:
                "Event whose start and end points are within the initial range.",
            label: "Normal Event Node",
        },
        {
            start: getModDateString(begin, {
                day: "+14",
                h: 1,
                min: 23,
                sec: 45,
            }),
            end: getModDateString(end, {
                month: "+1",
                h: 23,
                min: 59,
                sec: 59,
            }),
            row: 2,
            content: "Event whose endpoint is outside the initial range.",
            label: "Outrange Startpoint Event Node",
        },
        {
            start: getModDateString(begin, {
                month: "-1",
                h: 0,
                min: 0,
                sec: 0,
            }),
            end: getModDateString(begin, { day: "+4", h: 21, min: 30 }),
            row: 3,
            content: "Event whose startpoint is outside the initial range.",
            label: "Outrange Endpoint Event Node",
        },
        // straight lines: before
        {
            start: getModDateString(begin, { day: "+5", h: 12 }),
            row: 4,
            content: "The fourth event content.",
            label: "Event Node 4",
            id: 4,
            relation: { before: 6 },
        },
        {
            start: getModDateString(begin, { day: "+3", h: 12 }),
            row: 5,
            content: "The fifth event content.",
            label: "Event Node 5",
            id: 5,
            relation: { before: 4 },
        },
        {
            start: getModDateString(begin, { day: "+7", h: 12 }),
            row: 5,
            content: "The sixth event content.",
            label: "Event Node 6",
            id: 6,
            relation: { before: 7 },
        },
        {
            start: getModDateString(begin, { day: "+5", h: 12 }),
            row: 6,
            content: "The seventh event content.",
            label: "Event Node 7",
            id: 7,
            relation: { before: 5 },
        },
        // straight lines: after
        {
            start: getModDateString(begin, { day: "+11", h: 12 }),
            row: 4,
            content: "The eighth event content.",
            label: "Event Node 8",
            id: 8,
            relation: { after: 10, linecolor: "#00A960" },
            bdColor: "#00A960",
            bgColor: "#BEE0C2",
        },
        {
            start: getModDateString(begin, { day: "+9", h: 12 }),
            row: 5,
            content: "The ninth event content.",
            label: "Event Node 9",
            id: 9,
            relation: { after: 8, linecolor: "#EE7800" },
            bdColor: "#EE7800",
            bgColor: "#F2D58A",
        },
        {
            start: getModDateString(begin, { day: "+13", h: 12 }),
            row: 5,
            content: "The tenth event content.",
            label: "Event Node 10",
            id: 10,
            relation: { after: 11, linecolor: "#FFDC00" },
            bdColor: "#FFDC00",
            bgColor: "#EAEEA2",
        },
        {
            start: getModDateString(begin, { day: "+11", h: 12 }),
            row: 6,
            content: "The eleventh event content.",
            label: "Event Node 11",
            id: 11,
            relation: { after: 9, linecolor: "#0075C2" },
            bdColor: "#0075C2",
            bgColor: "#A0D8EF",
        },
        // curve lines: before only
        {
            start: getModDateString(begin, { day: "+7", h: 12 }),
            row: 8,
            content: "The 12th event content.",
            label: "Base event for relating before",
            id: 12,
            relation: { before: 13, curve: true },
        },
        {
            start: getModDateString(begin, { day: "+7", h: 12 }),
            row: 7,
            content: "The 13th event content.",
            label: "Event Node 13",
            id: 13,
            relation: { before: 14, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "+5", h: 12 }),
            row: 7,
            content: "The 14th event content.",
            label: "Event Node 14",
            id: 14,
            relation: { before: 15, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "+4", h: 12 }),
            row: 9,
            content: "The 15th event content.",
            label: "Event Node 15",
            id: 15,
            relation: { before: 16, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "+3", h: 12 }),
            row: 7,
            content: "The 16th event content.",
            label: "Event Node 16",
            id: 16,
            relation: { before: 12, curve: 1 },
        },
        // curve lines: after only
        {
            start: getModDateString(begin, { day: "+9", h: 12 }),
            row: 8,
            content: "The 17th event content.",
            label: "Event Node 17",
            id: 17,
            relation: { after: 18, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "+9", h: 12 }),
            row: 9,
            content: "The 18th event content.",
            label: "Event Node 18",
            id: 18,
            relation: { after: 19, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "+11", h: 12 }),
            row: 9,
            content: "The 19th event content.",
            label: "Event Node 19",
            id: 19,
            relation: { after: 20, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "+12", h: 12 }),
            row: 7,
            content: "The 20th event content.",
            label: "Event Node 20",
            id: 20,
            relation: { after: 21, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "+13", h: 12 }),
            row: 9,
            content: "The 21th event content.",
            label: "Event Node 21",
            id: 21,
            relation: { after: 17, curve: 1 },
        },
        // curve lines: before and after
        {
            start: getModDateString(begin, { day: "+8", h: 0 }),
            row: 10,
            content: "The 30th event content.",
            label: "Event Node 30",
            id: 30,
            relation: { before: 31, after: 32, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "+6", h: 0 }),
            row: 11,
            content: "The 31th event content.",
            label: "Event Node 31",
            id: 31,
            relation: { before: 34, after: 33, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "+10", h: 0 }),
            row: 11,
            content: "The 32th event content.",
            label: "Event Node 32",
            id: 32,
            relation: { before: 30, after: 35, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "+8", h: 0 }),
            row: 12,
            content: "The 33th event content.",
            label: "Event Node 33",
            id: 33,
            relation: { before: 31, after: 32, curve: 1 },
        },
        {
            start: getModDateString(begin, { day: "-3" }),
            row: 11,
            content: "The 34th event content.",
            label: "Event Node 34",
            id: 34,
            relation: { curve: true },
        },
        {
            start: getModDateString(end, { day: "+3" }),
            row: 11,
            content: "The 35th event content.",
            label: "Event Node 35",
            id: 35,
            relation: { curve: false },
        },
    ];
    return events;
}
function openDialog(nodes) {
    var $backdrop = $("<div></div>", { id: "backdrop-overlay" }),
        $dialog = $("<div></div>", { id: "dialog" }),
        $headline = $("<div></div>", { id: "dialog-header" }),
        $body = $("<div></div>", { id: "dialog-body" }),
        $footer = $("<div></div>", { id: "dialog-footer" }),
        $dismiss = $("<div></div>", { id: "dialog-dismiss" }),
        $close = $("<button></button>", { id: "dialog-close" });
    if ($(document).find("#backdrop-overlay").length == 0) {
        $("body").css({ position: "relative" });
        $backdrop.css({
            position: "absolute",
            top: 0,
            left: 0,
            width: "calc(100% + 2em)",
            height: "calc(100% + 2em)",
            margin: "-1em",
            padding: 0,
            backgroundColor: "rgba(51,51,51,0.4)",
            zIndex: 9999,
        });
        $backdrop.on("click", function () {
            closeDialog();
        });
        $("body").append($backdrop);
    } else {
        $(document)
            .find("#backdrop-overlay")
            .css({ display: "block", visibility: "visible" });
    }
    $dialog.css({
        position: "absolute",
        display: "flex",
        flexDirection: "column",
        justifyContent: "space-between",
        top: "50%",
        left: "50%",
        width: "60%",
        height: "60%",
        backgroundColor: "#FFF",
        borderRadius: "6px",
        zIndex: 10000,
        transform: "translate(-50%,-50%)",
        boxShadow: "0 0 10px 10px rgba(51,51,51,0.1)",
        opacity: 0,
    });
    $headline.css({
        display: "flex",
        flexDirection: "row",
        justifyContent: "space-between",
        margin: 0,
        padding: "4px 6px",
        borderRadius: "6px 6px 0 0",
        borderBottom: "dotted 1px #E8E8E8",
        backgroundColor: "#F4F4F4",
        zIndex: 10001,
    });
    $dismiss.css({
        textAlign: "center",
        verticalAlign: "middle",
        width: "90px",
    });
    $dismiss.append('<span class="dismiss-icon"></span>');
    $(document).on("click", ".dismiss-icon", function () {
        closeDialog();
    });
    $headline.append(nodes.label, $dismiss);
    $body.css({
        margin: 0,
        padding: "6px",
        height: "100%",
        backgroundColor: "#FFF",
        zIndex: 10001,
    });
    $body.append(nodes.content);
    $footer.css({
        margin: 0,
        display: "flex",
        flexDirection: "row",
        justifyContent: "end",
        alignContent: "end",
        padding: "10px 6px",
        borderRadius: "0 0 6px 6px",
        borderTop: "dotted 1px #E8E8E8",
        backgroundColor: "#FFF",
        zIndex: 10001,
    });
    $close
        .css({ margin: "auto", alignSelf: "end", textAlign: "right" })
        .text("Close");
    $footer.append($close);
    $close.on("click", function () {
        closeDialog();
    });
    $dialog.append($headline, $body, $footer);
    $("body").append($dialog);
    $dialog.animate({ opacity: 1 }, 300);
}
function closeDialog() {
    $("#dialog").animate({ opacity: 0 }, 150, "linear", function () {
        $(this).remove();
        $(document)
            .find("#backdrop-overlay")
            .css({ display: "none", visibility: "hidden" });
    });
}
