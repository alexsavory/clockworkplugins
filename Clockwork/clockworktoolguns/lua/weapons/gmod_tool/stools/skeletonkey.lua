TOOL.Category		= "Clockwork Tools [Tru]"
TOOL.Name			= "#Tool.skeletonkey.name"
TOOL.Command		= nil
TOOL.ConfigName		= ""


if CLIENT then
	language.Add( "Tool.skeletonkey.name", "Skeleton Key" )
	language.Add( "Tool.skeletonkey.desc", "Lock and Unlock all those doors!" )
	language.Add( "Tool.skeletonkey.0", "Primary: Lock Secondary: Unlock" )
	language.Add( "Tool.skeletonkey.descriptiontext", "No options for this!" )
end





function TOOL:LeftClick( tr )

	local ply = self:GetOwner()
	
	

if not ply:IsAdmin() then 
	return false
end
	
	

	if (tr.Entity:GetClass() == "player") then return false end
	if (CLIENT) then return true end

	local Ply = self:GetOwner()
	local door = Ply:GetEyeTraceNoCursor().Entity;
		
	if (IsValid(door) and Clockwork.entity:IsDoor(door)) then
		door:EmitSound("doors/door_latch3.wav");
		door:Fire("Lock", "", 0);
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
		door:EmitSound("doors/door_latch3.wav");
		door:Fire("Unlock", "", 0);
	else
		Clockwork.player:Notify(Ply, "This is not a valid door!");
	end;

end



function TOOL.BuildCPanel( CPanel )

	-- HEADER
	CPanel:AddControl( "Header", { Text = "#tool.skeletonkey.name", Description	= "#tool.skeletonkey.desc" }  )
	CPanel:AddControl( "Header", { Text = "#tool.skeletonkey.descriptiontext" }  )
end
