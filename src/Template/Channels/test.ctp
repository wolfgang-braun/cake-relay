<script type="text/javascript">
var conn = new WebSocket('ws://localhost:12345');
conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onmessage = function(e) {
    console.log(e.data);
};
</script>