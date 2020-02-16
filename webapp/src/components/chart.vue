<script>
import { Line } from 'vue-chartjs'

export default {
    extends: Line,
    name: 'Chart',
    props: {
        product : {
            type: Object,
            default: () => { }
        }
    },
    watch: {
        product: {
            handler: function () {
                this.setupChart();
            },
            immediate: true
        }
    },
    data() {
        return {
            chartLabels: [],
            chartDataSet: []
        }
    },
    mounted() {
    },
    methods: {
        displayChart() {
            this.renderChart(
            {
            labels: this.chartLabels,
            datasets: [
                {
                    label: 'Price',
                    data: this.chartDataSet,    
                }]
            },
            {
                responsive: true,
                maintainAspectRatio: false
            });
        },
        setupChart() {
            if (this.$props.product.prices) {
                this.$props.product.prices.forEach(x => {
                this.chartLabels.push(x.date);
                this.chartDataSet.push(x.price);
                });
                this.chartLabels.push(this.$props.product.updated_at);
                this.chartDataSet.push(this.$props.product.currentPrice);

                this.displayChart();
            }
           
        }
    }
}
</script>