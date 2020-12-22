import React from 'react';
import ImageUploader from 'react-images-upload';

export default class ImageUpload extends React.Component {

    constructor(props) {
        super(props);
        this.state = { pictures: [] };
        this.onDrop = this.onDrop.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
    }

    postImage(picture){
        let data = new FormData();
        data.append("fichier[file]", picture, picture.name);

        let myInit = {
            method: 'POST',
            body: data
        };

        fetch('admin/image',myInit)
            .then(response => {
                response.json().then(json => {
                    console.log(json)
                })
            });

    }

    onDrop(pictureInfo, data) {
        console.log("Je drop");
        console.log(pictureInfo);
        console.log(data);
        this.setState({
            pictures: pictureInfo
        });
    }

    onSubmit(event){
        event.preventDefault();
        console.log(this.state);
        this.postImage(this.state.pictures[0]);
    }

    render() {
        return (
            <form>
                {/* https://github.com/JakeHartnell/react-images-upload */}
                <ImageUploader
                    withIcon={true}
                    buttonText='Charger une image'
                    fileSizeError={'Le fichier est trop lourd'}
                    fileTypeError={'Le type du fichier (Extenssion) n\'est pas supporté'}
                    onChange={this.onDrop}
                    imgExtension={['.jpg', '.gif', '.png', '.gif']}
                    maxFileSize={5242880}
                    withPreview={true}
                />
                <button
                    onClick={this.onSubmit}
                    className={"btn btn-primary"}
                >
                    Envoyer
                </button>
            </form>
        );
    }
}
