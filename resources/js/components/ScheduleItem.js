import React from 'react';

export default (props) => (
    <div className="card my-2">
        <div className="card-header">{props.item.client}</div>
        <div className="card-body">
            {props.item.service}, {props.item.schedule}
            <br/> 
            {props.item.description}
        </div>
    </div>
)
