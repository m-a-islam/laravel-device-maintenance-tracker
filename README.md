## Requirements

Users can:

#### Create/list/update/delete Devices: name (string), serial_number (unique), status (enum: active|inactive).

#### Create/list/close Tickets for a device: title (string), description (text), state (open|closed), device_id (FK).

#### Web UI:

#### Device list page (+ create/edit form).

Ticket list filtered by device (+ create ticket form; ability to mark closed).

### JSON API:

POST /api/devices/{device}/tickets to create a ticket (validate required fields).

GET /api/devices/{device}/tickets?state=open|closed to list tickets (filtering).

Auth (simple): requests must include a header X-API-KEY that matches a value in .env.

Validation + error handling.

Bonus (if time): pagination, search by serial number, role “admin” restricting delete.
