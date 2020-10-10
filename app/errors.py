

def register_error_handlers(app):
    # @app.errorhandler(ValidationError)
    # def validation_error(ex):
    #     res = jsonify(ex.serialize())
    #     res.status_code = 400
    #     return res

    @app.errorhandler(Exception)
    def unhandled_exception(ex):
        return {
            'error': {
                'code': ex.__class__.__name__,
                'message': str(ex)
            }
        }