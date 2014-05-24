TOOL.Category		= "Clockwork Tools [Tru]"
TOOL.Name			= "#Tool.doorsetchild.name"
TOOL.Command		= nil
TOOL.ConfigName		= ""


if CLIENT then
	language.Add( "Tool.doorsetchild.name", "Door Set Child" )
	language.Add( "Tool.doorsetchild.desc", "Set child to active parent door." )
	language.Add( "Tool.doorsetchild.0", "Primary: Set child." )
	language.Add( "Tool.doorsetchild.descriptiontext", "No options for this!" )
end




function TOOL:LeftClick( tr )
	local Clockwork = Clockwork
	local Ply = self:GetOwner()
	


if not Ply:IsAdmin() then 
	return false
end
	local door = Ply:GetEyeTraceNoCursor().Entity;


if (IsValid(door) and Clockwork.entity:IsDoor(door)) then
		if (IsValid(player.cwParentDoor)) then
			cwDoorCmds.parentData[door] = player.cwParentDoor;
			cwDoorCmds:SaveParentData();
			
			Clockwork.entity:SetDoorParent(door, player.cwParentDoor);
			Clockwork.player:Notify(Ply, "You have added this as a child to the active parent door.");
		else
			Clockwork.player:Notify(Ply, "You have not selected a valid parent door!");
		end;
	else
		Clockwork.player:Notify(Ply, "This is not a valid door!");
	end;

end


function TOOL:RightClick( tr )
return false
end



function TOOL.BuildCPanel( CPanel )

	-- HEADER
	CPanel:AddControl( "Header", { Text = "#tool.doorsetchild.name", Description	= "#tool.doorsetchild.desc" }  )
	CPanel:AddControl( "Header", { Text = "#tool.doorsetchild.descriptiontext" }  )
end
