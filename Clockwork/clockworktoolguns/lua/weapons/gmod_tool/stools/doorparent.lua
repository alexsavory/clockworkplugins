TOOL.Category		= "Clockwork Tools [Tru]"
TOOL.Name			= "#Tool.doorparent.name"
TOOL.Command		= nil
TOOL.ConfigName		= ""


if CLIENT then
	language.Add( "Tool.doorparent.name", "Door Parent" )
	language.Add( "Tool.doorparent.desc", "Make sure you unparent a door before you move on." )
	language.Add( "Tool.doorparent.0", "Primary: Set Parent Secondary: Unparent" )
	language.Add( "Tool.doorparent.descriptiontext", "No options for this!" )
end




function TOOL:LeftClick( tr )

	local Ply = self:GetOwner()
	


if not Ply:IsAdmin() then 
	return false
end
	local door = Ply:GetEyeTraceNoCursor().Entity;


	-- Clear parent, cus people are lazy
		--cwDoorCmds.parentData[door] = nil;
		--cwDoorCmds:SaveParentData();

	if (IsValid(door) and Clockwork.entity:IsDoor(door)) then
		
		player.cwParentDoor = door;
		-- So you can see the door if you go behind a wall.
		door:SetMaterial("pp/copy")
		Clockwork.player:Notify(Ply, "You have set the active parent door to this.");
	else
		Clockwork.player:Notify(Ply, "This is not a valid door!");
	end;

end


function TOOL:RightClick( tr )

	local ply = self:GetOwner()


if not ply:IsAdmin() then 
	return false
end
	
	

	if (tr.Entity:GetClass() == "player") then return false end
	if (CLIENT) then return true end

	local Ply = self:GetOwner()
	local door = Ply:GetEyeTraceNoCursor().Entity;
		
	if (IsValid(door) and Clockwork.entity:IsDoor(door)) then
		cwDoorCmds.parentData[door] = nil;
		cwDoorCmds:SaveParentData();
		
		Clockwork.entity:SetDoorParent(door, false);
		
		Clockwork.player:Notify(Ply, "You have unparented this door.");

		door:SetMaterial("")
	else
		Clockwork.player:Notify(Ply, "This is not a valid door!");
	end;

end



function TOOL.BuildCPanel( CPanel )

	-- HEADER
	CPanel:AddControl( "Header", { Text = "#tool.doorparent.name", Description	= "#tool.doorparent.desc" }  )
	CPanel:AddControl( "Header", { Text = "#tool.doorparent.descriptiontext" }  )
end
