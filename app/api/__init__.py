from flask_restful import Api

from api.routes.v1.utils import Utils

def create_api(app):
    api = Api(app)
    api.add_resource(Utils, '/utils')
