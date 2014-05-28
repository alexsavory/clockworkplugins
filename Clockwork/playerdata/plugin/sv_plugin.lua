Clockwork.datastream:Hook("PlayerData", function(player, data)
	if (type( data[2] ) == "string") then
		data[1]:SetData( "playerdata", string.sub(data[2], 0, 500) );
		
		player.editDataAuthorised = nil;
	end;
end);