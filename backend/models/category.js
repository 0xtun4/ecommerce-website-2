const mongoose = require('mongoose');

const categorySchema = mongoose.Schema({
    label: {
        type: String,
        required: true,
    },
    data_value: {
        type: String,
        required: true,
    },
    icon: {
        type: String,
    },
    color: { 
        type: String,
    }
})


categorySchema.method('toJSON', function() {
    const { __v, data_value, ...object } = this.toObject();
    const { _id:id, ...result } = object;
    return { ...result, id, value: id };
});


exports.Category = mongoose.model('Category', categorySchema);
