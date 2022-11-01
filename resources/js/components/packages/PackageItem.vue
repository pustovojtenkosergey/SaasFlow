<template>
    <div class="col-md-5 border p-2 m-1 item-block" :class="{'border-danger': isHovering}">
        <button type="button"
                class="btn btn-sm btn-circle btn-danger float-right"
                v-if="!isFirst"
                @click="remove(item.index)"
                @mouseover="isHovering = true"
                @mouseout="isHovering = false"
        >
            <font-awesome-icon icon="fa-solid fa-trash" />
        </button>
        <div class="form-row my-2">
            <input type="number"
                   class="form-control w-25 mr-3"
                   :id="item.index + '-quantity'"
                   min="1"
                   v-model="formItem.quantity"
                   :disabled="globalRand"
            >
            <label :for="item.index + '-quantity'">Quantity</label>
        </div>
        <div class="form-row my-2">
                    <textarea class="form-control"
                              :id="item.index + '-description'"
                              v-model="formItem.description"
                              :disabled="globalRand"
                              rows="2">
                    </textarea>
            <label :for="item.index + '-description'">Description</label>
        </div>
        <div class="form-row my-2">
            <input type="number"
                   class="form-control"
                   :id="item.index + '-item_value_amount'"
                   :disabled="globalRand"
                   v-model="formItem.value_amount"
            >
            <label :for="item.index + '-item_value_amount'">Value</label>
            <select class="custom-select"
                    :id="item.index + '-item_value_currency'"
                    v-model="formItem.extra.value_currency"
                    :disabled="!isFirst || globalRand"
            >
                <option v-for="currency in currencies" :value="currency">{{ currency }}</option>
            </select>
            <label :for="item.index + '-item_value_currency'">Currency</label>
        </div>
        <div class="form-row my-2">
            <select class="custom-select"
                    :id="item.index + '-country_of_origin'"
                    :disabled="globalRand"
                    v-model="formItem.country_of_origin"
            >
                <option selected disabled value="">Choose...</option>
                <option v-for="(country, alpha2)  in countries" :value="alpha2">{{ country }}</option>
            </select>
            <label :for="item.index + '-country_of_origin'">Country of origin</label>
        </div>
        <div class="form-row my-2">
            <input type="text"
                   class="form-control"
                   :id="item.index + '-sku'"
                   :disabled="globalRand"
                   v-model="formItem.sku"
            >
            <label :for="item.index + '-sku'">Sku</label>
        </div>
        <div class="form-row my-2">
            <input type="text"
                   class="form-control"
                   :id="item.index + '-hs_code'"
                   :disabled="globalRand"
                   v-model="formItem.hs_code"
            >
            <label :for="item.index + '-hs_code'">hs code</label>
        </div>
    </div>

</template>

<script>

export default {
    props: ['getItem', 'remove', 'isFirst', 'index', 'item', 'currencies', 'countries', 'makeId', 'globalRand'],
    data() {
        return {
            isHovering: false,
            savedFormItem: {},
            formItem: {...this.item}
        }
    },
    watch: {
        globalRand(value) {
            if (value) {
                this.savedFormItem = {...this.formItem};
            } else {
                this.formItem = {...this.savedFormItem};
                this.savedFormItem = {};
            }
            this.setRand();
        },
        formItem: {
            handler(data) {
                this.getItem(data, this.item.index);
            },
            deep: true
        }
    },
    mounted() {

    },
    methods: {
        setRand() {
            const randItem = {};
            randItem.quantity = Math.floor(Math.random() * 10) + 1;
            randItem.description = 'Test package';
            randItem.value_amount = Math.floor(Math.random() * 100) + 1;

            randItem.extra = {
                value_currency: this.formItem.extra.value_currency
            };
            const countries = Object.keys(this.countries);
            const randomCountry = Math.floor(Math.random() * countries.length);
            randItem.country_of_origin = countries[randomCountry];

            randItem.sku = this.makeId(5);
            randItem.hs_code = this.makeId(10);
            this.formItem = {...randItem};
        }
    }
}
</script>
