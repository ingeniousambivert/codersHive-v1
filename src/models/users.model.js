// users-model.js - A mongoose model
//
// See http://mongoosejs.com/docs/models.html
// for more of what you can do here.
module.exports = function (app) {
  const modelName = 'users';
  const mongooseClient = app.get('mongooseClient');
  const { ObjectId } = mongooseClient.Schema.Types;

  const schema = new mongooseClient.Schema(
    {
      firstname: {
        type: String,
        required: true
      },
      lastname: {
        type: String,
        required: true
      },
      email: {
        index: true,
        type: String,
        unique: true,
        lowercase: true,
        required: true
      },
      password: {
        type: String,
        required: true
      },
      active: {
        type: Boolean,
        default: true
      },
      isVerified: {
        type: Boolean,
        default: true
      },
      projects: {
        type: ObjectId,
        ref: 'projects'
      },
    },
    {
      timestamps: true
    }
  );


  // This is necessary to avoid model compilation errors in watch mode
  // see https://mongoosejs.com/docs/api/connection.html#connection_Connection-deleteModel
  if (mongooseClient.modelNames().includes(modelName)) {
    mongooseClient.deleteModel(modelName);
  }
  return mongooseClient.model(modelName, schema);

};
