const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
let pond;

$(() => {
    // Activity Logs
    if (window.location.href === route("staff.activity_logs.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "description" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            { data: "properties.ip" },
        ];
        c_index(
            $(".activitylog_dt"),
            route("staff.activity_logs.index"),
            columns
        );
    }

    /** Start Service Management */

    //Service Category;
    if (window.location.href === route("staff.service_categories.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".service_category_dt"),
            route("staff.service_categories.index"),
            columns
        );
    }

    // Manage Services
    if (window.location.href === route("staff.services.index")) {
        const columns = [
            { data: "name" },
            { data: "service_category.name" },
            { data: "description" },
            {
                data: "fee",
            },

            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".service_dt"), route("staff.services.index"), columns);
    }

    /** End Service Management */

    /** Start Pet Management */

    //Pet Category;
    if (window.location.href === route("staff.categories.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            { data: "name" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".category_dt"), route("staff.categories.index"), columns);
    }

    // Pet

    if (window.location.href === route("staff.pets.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "avatar",
                render(data) {
                    return handlleNullAvatarForPet(data, "", 50);
                },
            },
            { data: "name" },
            { data: "breed" },
            { data: "category" },
            { data: "customer" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".pet_dt"), route("staff.pets.index"), columns);
    }

    /** End Pet Management */

    /** Start Appointment / Booking Management */

    // Manage Schedule
    if (window.location.href === route("staff.schedules.index")) {
        const columns = [
            {
                data: "service",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            {
                data: "date_time_start",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            {
                data: "date_time_end",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            {
                data: "day_type",
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
        ];
        c_index($(".schedule_dt"), route("staff.schedules.index"), columns);
    }

    //Bookings;
    if (window.location.href === route("staff.bookings.index")) {
        const booking_data = [
            {
                data: "id",
                render(data, type, row, meta) {
                    return row.DT_RowIndex;
                },
            },
            { data: "customer" },
            { data: "pet" },
            { data: "service" },
            { data: "schedule" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            {
                data: "is_online",
                render(data) {
                    return isOnline(data);
                },
            },
            {
                data: "status",
                render(data) {
                    return handleBookingStatus(data);
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".booking_dt"), route("staff.bookings.index"), booking_data);
    }

    /** End Appointment / Booking Management */

    // Customer
    if (window.location.href === route("staff.customers.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row, meta) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "first_name",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },

            {
                data: "middle_name",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            {
                data: "last_name",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            {
                data: "sex",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },

            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".customer_dt"), route("staff.customers.index"), columns);
    }

    //User;
    if (window.location.href === route("staff.users.index")) {
        const columns = [
            {
                data: "id",
                render(data, type, row) {
                    return row.DT_RowIndex;
                },
            },
            {
                data: "avatar",
                render(data) {
                    return handleNullAvatar(data);
                },
            },
            { data: "name" },
            {
                data: "email_verified_at",
                render(data) {
                    return isVerified(data);
                },
            },
            {
                data: "role",
                render(data) {
                    return `<span class='badge badge-primary'>${data}</span>`;
                },
            },
            {
                data: "is_activated",
                render(data) {
                    return isActivated(data);
                },
            },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data.date, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".user_dt"), route("staff.users.index"), columns);
    }
});

//=========================================================
// Custom Functions()

document.addEventListener("DOMContentLoaded", function (event) {
    // initiate global glightbox

    setTimeout(() => {
        GLightbox({
            selector: ".glightbox",
        });
    }, 1000);
});

function filterScheduleByService(service) {
    if (service.value) {
        const columns = [
            {
                data: "service",
                render(data) {
                    return `<span class='text-capitalize'>${data}</span>`;
                },
            },
            {
                data: "date_time_start",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            {
                data: "date_time_end",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            { data: "day_type" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".schedule_dt"),
            route("staff.schedules.index", {
                service: service.value,
            }),
            columns,
            null,
            true
        );
    }
}
