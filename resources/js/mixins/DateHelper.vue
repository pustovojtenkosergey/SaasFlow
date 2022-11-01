<script>
import moment from "moment";

const DATE_FORMAT = 'MMMM Do YYYY, h:mm:ss a';

export default {
    methods: {
        getNowDate() {
            return moment().format(DATE_FORMAT)
        },
        createDate(date) {
            return moment(date).format(DATE_FORMAT)
        }
    }
}
</script>
